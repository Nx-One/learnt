<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'type',
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
    public function course()
    {
        return $this->belongsTo(Course::class, 'unit_id', 'id');
    }
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
