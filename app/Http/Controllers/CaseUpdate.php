<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\User;
use Illuminate\Http\Request;

class CaseUpdate extends Controller
{
    //Get Division Details
    public function getDivisionDetails($divisionId)
    {
        // Get all judges in this division
        $judges = User::where('division', $divisionId)->where('usertype', 'judge')->get();

        // Get cases assigned to this division
        $cases = CaseModel::where('division', $divisionId)->get();

        // Pass data to a view that will render the modal content
        return view('appealEase.systemAdmin.dashboard.divisionDetails', compact('judges', 'cases'));
    }
}
