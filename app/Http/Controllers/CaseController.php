<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\Requirement;
use Illuminate\Http\Request;

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
}
