<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'score',
        'assessment_id',
        'user_id',
    ];
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
