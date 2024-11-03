<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $casts = [
        'deadline' => 'datetime',
    ];

    // A case can have multiple decisions from different judges
    public function decisions()
    {
        return $this->hasMany(Decision::class, 'case_id');
    }

    // Relationship with CaseSolved
    public function caseSolved()
    {
        return $this->hasMany(CasesSolved::class, 'case_id');
    }
}
