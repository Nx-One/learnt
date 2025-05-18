<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'link',
        'user_id',
        'unit_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function score()
    {
        return $this->hasOne(Score::class);
    }
}
