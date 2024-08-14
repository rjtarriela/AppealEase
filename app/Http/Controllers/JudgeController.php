<?php

namespace App\Http\Controllers;

use App\Models\Judge;
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
}
