<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\CasesSolved;
use App\Models\Decision;
use App\Models\Judge;
use App\Models\Remark;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    //
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
        // $case->case_requirement = json_encode($request->case_requirement); // maybe not needed

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

        // dd(time());

        return redirect('/dashboard')->with('success', 'Case submitted successfully!');
    }

    public function destroy($id)
    {
        $case = CaseModel::findOrFail($id);
        $case->delete();

        return redirect('/dashboard')->with('success', 'Case deleted successfully!');
    }

    public function send($id)
    {
        $case = CaseModel::findOrFail($id);
        $case->status = 'sent'; // Assuming you have a status column in your cases table
        $case->save();

        return redirect('/dashboard')->with('success', 'Case sent successfully!');
    }

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
        // dd($votesCount);

        if ($votesCount < $totalJustices) {
            $case->adminStatus = "Pending: $votesCount/$totalJustices";
        } else if ($votesCount == $totalJustices) {
            $case->adminStatus = "Completed";
        }

        // $case->remarks = $request->input('remarks'); // remarks must show all the justices remarks.

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
            } else {
                $case->verdictStatus = 'Acquitted';
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

        // // logic for number of justices in a division
        // $user = Auth::user();
        // $userDivision = $user->division;
        // $divisionCount = User::where('division',  $userDivision)->where('usertype', 'judge')->count();

        // dd($id);
        // $case = CaseModel::findOrFail($id);

        // // $case = new CaseModel();


        // $division = CasesSolved::where('division_id', $case->division)->firstOrFail();

        // $case->approvalStatus = 'approved'; // Assuming you have a status column in your cases table
        // $case->adminStatus = $request->adminStatus;
        // $case->remarks = $request->input('remarks');
        // $case->case_judgeID = $division->division_id; // division na dapat to
        // $case->save();

        // if ($case->case_type == 'civil') {
        //     $division->civil_cases_solved += 1;
        // } else if ($case->case_type == 'criminal') {
        //     $division->criminal_cases_solved += 1;
        // } else {
        //     $division->special_cases_solved += 1;
        // }
        // $division->save();

        return redirect()->back()->with('success', 'Submitted successfully!');
    }

    public function denied(Request $request, $id)
    {
        $case = CaseModel::findOrFail($id);
        $case->approvalStatus = 'denied'; // Assuming you have a status column in your cases table
        $case->remarks = $request->input('remarks');
        $case->save();
        return redirect('/dashboard')->with('success', 'Submitted successfully!');
    }

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

        // Update the related judges to ensure they can receive the case
        // User::where('division', $randomDivision)->update(['statusRandom' => 'assigned']);

        // Return back to the dashboard with a success message
        return redirect('/dashboard')->with('success', 'Case Assigned to a Division Successfully!');
    }

    public function viewCases($judgeId)
    {
        $cases = CaseModel::where('case_judgeID', $judgeId)->get();
        $judge = User::findOrFail($judgeId);

        return view('appealEase.systemAdmin.dashboard.view-cases', compact('cases', 'judge'));
    }

    public function sendToSupremeCourt($id)
    {
        $case = CaseModel::findOrFail($id);
        $case->adminStatus = 'Sent to Supreme Court';
        $case->save();

        return redirect('/approved-cases')->with('success', 'Case sent successfully!');
    }

    public function update(Request $request, $id)
    {
        $case = CaseModel::findOrFail($id);
        $case->case_requirement = json_encode($request->case_requirement);
        $case->save();

        return redirect()->back()->with('success', 'Case requirements updated successfully.');
    }

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
