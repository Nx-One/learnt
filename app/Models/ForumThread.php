<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ForumThread extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'course_id',
        'unit_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function post()
    {
        return $this->hasMany(ForumPost::class,'thread_id')->orderBy('created_at', 'desc');
    }
}
