<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasesSolved extends Model
{
    use HasFactory;

    protected $table = 'cases_solved';

    protected $fillable = [
        'case_id',       // Add this to allow mass assignment
        'division_id',   // Ensure other necessary fields are also here
        'criminal_cases_solved',
        'civil_cases_solved',
        'special_cases_solved',
    ];

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function division()
    {
        return $this->belongsTo(User::class, 'division', 'division_id');
    }
}
