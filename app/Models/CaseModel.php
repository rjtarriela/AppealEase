<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    use HasFactory;

    protected $table = 'cases';

    // A case can have multiple decisions from different judges
    public function decisions()
    {
        return $this->hasMany(Decision::class, 'case_id');
    }

    // public function judges()
    // {
    //     return $this->belongsToMany(User::class, 'case_judge', 'case_id', 'judge_id');
    // }
}
