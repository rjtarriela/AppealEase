<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseRequirementController extends Controller
{
    //No need na ata. Delete na!
    public function store(Request $request)
    {
        $requirement = new Requirement();
        $requirement->id = $request->id;
        $requirement->requirement_name = $request->requirement_name;
        $requirement->description = $request->description;
        $requirement->case_type = $request->case_type;
        $requirement->save();

        return redirect('/requirement-details')->with('success', 'Requirement submitted successfully!');
    }

    public function update(Request $request, $id)
    {
        $requirement = Requirement::findOrFail($id);
        $requirement->requirement_name = $request->requirement_name;
        $requirement->description = $request->description;
        $requirement->save();

        return redirect('/requirement-details')->with('success', 'Requirement updated successfully!');
    }

    public function destroy($id)
    {
        $requirement = Requirement::findOrFail($id);
        $requirement->delete();

        return redirect('/requirement-details')->with('success', 'Requirement deleted successfully!');
    }
}
