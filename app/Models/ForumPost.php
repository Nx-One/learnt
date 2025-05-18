<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
        'thread_id',
        'parent_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function thread()
    {
        return $this->belongsTo(ForumThread::class)->orderBy('created_at', 'desc');
    }
    public function parent()
    {
        return $this->belongsTo(ForumPost::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(ForumPost::class, 'parent_id');
    }
}
