<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\Decision;
use App\Models\Judge;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    //
    public function store(Request $request)
    {
        $case = new CaseModel();
        $case->id = $request->id;
        $case->case_number = $request->case_number;
        $case->case_type = $request->case_type;
        $case->case_court = $request->case_court;
        $case->case_judge = $request->case_judge;
        $case->case_requirement = json_encode($request->case_requirement);
        $case->save();

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
        // dd($id);
        $case = CaseModel::findOrFail($id);
        $judge = User::where('division', $case->division) // Assuming you have a division field
                ->where('judgeRole', 'head') // Assuming 'head' is the value for head judges
                ->firstOrFail();

        $case->approvalStatus = 'approved'; // Assuming you have a status column in your cases table
        $case->adminStatus = $request->adminStatus;
        $case->remarks = $request->input('remarks');
        $case->case_judgeID = $judge->id;
        $case->save();

        if ($case->case_type == 'civil') {
            $judge->civil_cases_solved += 1;
        } else if ($case->case_type == 'criminal') {
            $judge->criminal_cases_solved += 1;
        } else {
            $judge->special_cases_solved += 1;
        }
        $judge->save();


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
        $case->save();

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
