<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'sub_unit_id',
    ];

    public function subUnit()
    {
        return $this->belongsTo(SubUnit::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
