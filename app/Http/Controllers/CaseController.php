<?php

namespace App\Http\Controllers;

use App\Mail\CaseCompleteMail;
use App\Mail\NotifEmail;
use App\Models\CaseModel;
use App\Models\CasesSolved;
use App\Models\Decision;
use App\Models\History;
use App\Models\Judge;
use App\Models\Remark;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
  // CAMIS store requested data
  public function store(Request $request)
  {
    $requiredFields = ['pleading', 'evidences', 'verification', 'certificate', 'judicial_affidavit', 'notice_of_appeal', 'documents'];
    $nullableFields = ['other_files', 'memoranda'];

    $validationRules = [];

    foreach ($requiredFields as $field) {
      $validationRules["{$field}.*"] = 'required|file|mimes:pdf'; // 2MB max size
    }

    foreach ($nullableFields as $field) {
      $validationRules["{$field}.*"] = 'nullable|file|mimes:pdf'; // 2MB max size
    }

    $request->validate($validationRules);

    $filePaths = [];
    $formattedDate = date('Ymd_His');

    // Array of all fields that may contain files
    $fileFields = array_merge($requiredFields, $nullableFields);

    foreach ($fileFields as $field) {
      if ($request->hasFile($field)) {
        foreach ($request->file($field) as $file) {
          // Generate a unique name for the file before saving it
          $filename = $formattedDate . '_' . $file->getClientOriginalName();

          // Store the file in the 'uploads' directory
          $filePath = $file->storeAs('uploads', $filename, 'public'); // stored in storage/app/public

          // Add the file path to the array
          $filePaths[$field][] = $filePath;
        }
      }
    }

    $case = new CaseModel();
    $case->id = $request->id;
    $case->case_number = $request->case_number;
    $case->case_type = $request->case_type;
    $case->case_court = $request->case_court;
    $case->case_judge = $request->case_judge;

    $case->litigant_name = $request->litigant_name;
    $case->email_address = $request->email_address;
    $case->contact_number = $request->contact_number;
    $case->license_number = $request->license_number;

    $case->case_title = $request->case_title;
    $case->name_of_filing_party = $request->name_of_filing_party;

    $case->other_files = json_encode($filePaths['other_files'] ?? []);
    $case->pleading = json_encode($filePaths['pleading'] ?? []);
    $case->evidences = json_encode($filePaths['evidences'] ?? []);
    $case->verification = json_encode($filePaths['verification'] ?? []);
    $case->certificate = json_encode($filePaths['certificate'] ?? []);
    $case->judicial_affidavit = json_encode($filePaths['judicial_affidavit'] ?? []);
    $case->notice_of_appeal = json_encode($filePaths['notice_of_appeal'] ?? []);
    $case->documents = json_encode($filePaths['documents'] ?? []);
    $case->memoranda = json_encode($filePaths['memoranda'] ?? []);

    $case->save();

    return redirect('/dashboard')->with('success', 'Case submitted successfully!');
  }

  // CAMIS delete function
  public function destroy($id)
  {
    $case = CaseModel::findOrFail($id);

    // List of fields that store file paths
    $fileFields = [
      'pleading',
      'evidences',
      'verification',
      'certificate',
      'judicial_affidavit',
      'notice_of_appeal',
      'documents',
      'other_files',
      'memoranda'
    ];

    // Iterate over each file field to delete stored files
    foreach ($fileFields as $field) {
      if (!empty($case->{$field})) {
        $filePaths = json_decode($case->{$field}, true);

        if (is_array($filePaths)) {
          foreach ($filePaths as $filePath) {
            if (Storage::disk('public')->exists($filePath)) {
              Storage::disk('public')->delete($filePath);
            }
          }
        }
      }
    }


    $case->delete();

    return redirect('/dashboard')->with('success', 'Case deleted successfully!');
  }

  // Update status for case (sent)
  public function send($id)
  {
    $case = CaseModel::findOrFail($id);
    $case->status = 'sent';
    $case->save();

    return redirect('/dashboard')->with('success', 'Case sent successfully!');
  }

  // Updating the vote counts, remarks, and decision, JUSTICES
  public function approved(Request $request, $id)
  {
    $user = Auth::user();
    $case = CaseModel::findOrFail($id);

    // Get all justices in the division
    $justices = User::where('division', $user->division)
      ->where('usertype', 'judge')
      ->pluck('id');

    // Save the individual judge's decision
    Decision::updateOrCreate(
      ['case_id' => $case->id, 'judge_id' => $user->id],
      ['decision' => $request->decision, 'remarks' => $request->remarks]
    );

    // Get the total number of justices and their votes
    $totalJustices = $justices->count();
    $votesCount = Decision::where('case_id', $case->id)->count();

    if ($votesCount < $totalJustices) {
      $case->adminStatus = "Pending: $votesCount/$totalJustices";
    } else if ($votesCount == $totalJustices) {
      $case->adminStatus = "Completed";
    }

    if ($votesCount == $totalJustices) {
      // Calculate the majority verdict
      $affirmedVotes = Decision::where('case_id', $case->id)
        ->where('decision', 'affirmed')
        ->count();
      $acquittedVotes = Decision::where('case_id', $case->id)
        ->where('decision', 'acquitted')
        ->count();

      // Update verdictStatus based on majority votes
      if ($affirmedVotes > $acquittedVotes) {
        $case->verdictStatus = 'Affirmed';
        // $case->statusRandom = 'assigned';
        // Update the division's solved case counts
        $division = CasesSolved::where('division_id', $case->division)->firstOrFail();
        if ($case->case_type == 'civil') {
          $division->civil_cases_solved += 1;
        } elseif ($case->case_type == 'criminal') {
          $division->criminal_cases_solved += 1;
        } else {
          $division->special_cases_solved += 1;
        }
        $division->save();
      } else if ($affirmedVotes < $acquittedVotes) {
        $case->verdictStatus = 'Acquitted';
        // $case->statusRandom = 'assigned';
        $division = CasesSolved::where('division_id', $case->division)->firstOrFail();
        if ($case->case_type == 'civil') {
          $division->civil_cases_solved += 1;
        } elseif ($case->case_type == 'criminal') {
          $division->criminal_cases_solved += 1;
        } else {
          $division->special_cases_solved += 1;
        }
        $division->save();
      } else if ($affirmedVotes == 0 && $acquittedVotes == 0) {
        $case->verdictStatus = 'Inhibited';
        $case->statusRandom = 'unassigned';
      } else {
        $case->verdictStatus = 'Status Quo';
        // $case->statusRandom = 'assigned';
        $division = CasesSolved::where('division_id', $case->division)->firstOrFail();
        if ($case->case_type == 'civil') {
          $division->civil_cases_solved += 1;
        } elseif ($case->case_type == 'criminal') {
          $division->criminal_cases_solved += 1;
        } else {
          $division->special_cases_solved += 1;
        }
        $division->save();
      }
    }

    $case->save();

    if ($votesCount == $totalJustices) {
      $data = [
        'case_number' => $case->case_number, // Case number (dynamically passed)
        'case_type' => $case->case_type,     // Case type (dynamically passed)
        'division' => $case->division,       // Division
        'verdictStatus' => $case->verdictStatus,
        'date' => now()->toFormattedDateString(), // Current date in a readable format
      ];
      Mail::to($case->email_address)->send(new CaseCompleteMail($data));
    }
    return redirect()->back()->with('success', 'Submitted successfully!');
  }

  // Denied cases, idk if still needed. Already removed this function.
  public function denied(Request $request, $id)
  {
    $case = CaseModel::findOrFail($id);
    $case->approvalStatus = 'denied'; // Assuming you have a status column in your cases table
    $case->remarks = $request->input('remarks');
    $case->save();
    return redirect('/dashboard')->with('success', 'Submitted successfully!');
  }

  // Judge Randomization. Not needed.
  public function assignRandomJudge($id)
  {
    // Find the case
    $case = CaseModel::findOrFail($id);

    // Get a random judge from your judges table
    $judge = User::where('usertype', 'judge')->inRandomOrder()->first();

    // Assign the random judge to the case
    $case->case_judgeID = $judge->id; // Assuming you store the judge's id in case_judgeID
    $case->statusRandom = 'assigned'; // Update status if needed
    $case->save();

    // Return back to the dashboard with a success message
    return redirect('/dashboard')->with('success', 'Case assigned successfully!');
  }

  // Division Randomization.
  public function assignRandomDivision($id)
  {
    // Get a list of all available divisions
    $divisions = User::whereNotNull('division')->distinct()->pluck('division')->toArray();

    // Randomly select one division
    $randomDivision = $divisions[array_rand($divisions)];

    // Update the case with the randomly selected division
    $case = CaseModel::findOrFail($id);
    $case->statusRandom = 'assigned';
    $case->division = $randomDivision;
    $case->verdictStatus = 'Pending';
    $case->deadline = now()->addYear();

    Decision::where('case_id', $case->id)->delete();

    // Get total number of judges in the selected division
    $totalJudgesInDivision = User::where('division', $randomDivision)->where('usertype', 'judge')->count();


    $votesReceived = 0; // Initial vote count (assuming 0 if not started yet)
    $case->adminStatus = 'Pending: ' . $votesReceived . '/' . $totalJudgesInDivision;

    $case->save();

    // Add an initial record to the cases_solved table for this case
    CasesSolved::create([
      'case_id' => $case->id,
      'division_id' => $case->division,
      'criminal_cases_solved' => 0,
      'civil_cases_solved' => 0,
      'special_cases_solved' => 0,
    ]);

    History::create([
      'case_id' => $case->id, // Use case_number instead of case_id
      'division' => $randomDivision,
      'action' => 'Randomized Assignment',
    ]);

    // para sa email
    $receiver = User::where('division', $randomDivision)->where('usertype', 'judge')->get();
    foreach ($receiver as $user) {
      $data = [
        'name' => $user->name,               // Judge's name
        'case_number' => $case->case_number, // Case number (dynamically passed)
        'case_type' => $case->case_type,     // Case type (dynamically passed)
        'division' => $randomDivision,       // Division
        'date' => now()->toFormattedDateString(), // Current date in a readable format
      ];

      // Send the email
      Mail::to($user->email)->send(new NotifEmail($data));
    }

    Mail::to($case->email_address)->send(new NotifEmail($data));


    return redirect('/dashboard')->with('success', "Case Assigned to Division {$case->division} Successfully!");
    // ->with('randomDivision', $randomDivision);
  }

  // View Cases Button? Probably Not needed too.
  public function viewCases($judgeId)
  {
    $cases = CaseModel::where('case_judgeID', $judgeId)->get();
    $judge = User::findOrFail($judgeId);

    return view('appealEase.systemAdmin.dashboard.view-cases', compact('cases', 'judge'));
  }

  // Admin Status updated to "Sent to Supreme Court"
  public function sendToSupremeCourt($id)
  {
    $case = CaseModel::findOrFail($id);
    $case->adminStatus = 'Sent to Supreme Court';
    $case->save();

    return redirect('/approved-cases')->with('success', 'Case sent successfully!');
  }

  // Update the requirements. CAMIS. IDK if needed too. Nvm. deleted too.
  public function update(Request $request, $id)
  {
    $case = CaseModel::findOrFail($id);
    $case->case_requirement = json_encode($request->case_requirement);
    $case->save();

    return redirect()->back()->with('success', 'Case requirements updated successfully.');
  }

  // Maybe needed? but idk.
  public function storeDecision(Request $request, $caseId)
  {
    $decision = Decision::updateOrCreate(
      [
        'case_id' => $caseId,
        'judge_id' => Auth::id(),
      ],
      [
        'decision' => $request->decision,
      ]
    );

    return redirect()->back()->with('success', 'Decision saved successfully!');
  }
}
