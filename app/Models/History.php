<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = ['case_id', 'division', 'action'];

    public function case()
    {
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
}
