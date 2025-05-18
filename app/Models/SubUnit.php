<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class SubUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'name',
        'description',
        'video_url',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }
}
