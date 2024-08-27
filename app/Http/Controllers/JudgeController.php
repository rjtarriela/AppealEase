<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\User;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    //
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255|unique:judges,email,'.$id,
        //     'contact_number' => 'required|string|max:15',
        //     'criminal_cases_solved' => 'required|integer',
        //     'civil_cases_solved' => 'required|integer',
        //     'special_cases_solved' => 'required|integer',
        // ]);

        $judge = Judge::findOrFail($id);
        $judge->name = $request->name;
        $judge->division = $request->division;
        $judge->email = $request->email;
        $judge->contact_number = $request->contact_number;
        $judge->save();

        return redirect('/dashboard')->with('success', 'Judge updated successfully!');
    }
    public function destroy($id)
    {
        $judge = Judge::findOrFail($id);
        $judge->delete();

        return redirect('/dashboard')->with('success', 'Judge deleted successfully!');
    }

    public function updateRole($id, $role)
    {
        // Validate the role
        if (!in_array($role, ['normal', 'head'])) {
            return redirect()->back()->with('error', 'Invalid role selected.');
        }

        // Find the judge and update the role
        $judge = User::findOrFail($id);
        $judge->judgeRole = $role;
        $judge->save();

        return redirect()->back()->with('success', 'Judge role updated successfully.');
    }
}
