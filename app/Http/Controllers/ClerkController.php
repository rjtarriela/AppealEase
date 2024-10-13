<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use Illuminate\Http\Request;

class ClerkController extends Controller
{
    //Delete na ata to!

    public function markAsReceived($id)
    {
        $case = CaseModel::where('id', $id)->firstOrFail();
        $case->status = 'received'; // Change the status to received
        $case->save();

        return redirect()->back()->with('success', 'Case marked as received!');
    }
}
