<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subUnit()
    {
        return $this->hasMany(SubUnit::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function count_progress()
    {
        // get how many course
        $total_course = $this->course->count();

        // get how many sub unit
        $total_sub_unit = $this->subUnit->count();

        // get how many subUnit in userProgress
        $total_sub_unit_progress = SubUnit::whereHas('userProgress', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->count();

        $count_percentage = ($total_sub_unit_progress / $total_sub_unit) * 100;
        return $count_percentage;
    }
}
