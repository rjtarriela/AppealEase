<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    protected $fillable = ['case_id', 'user_id', 'remark'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function case()
    {
        return $this->belongsTo(CaseModel::class);
    }
}

// Delete na rin ata to