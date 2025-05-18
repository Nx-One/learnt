<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
        'sub_unit_id',
        'question_id',
        'is_completed',
        'progress',
        'score',
        'is_correct',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
