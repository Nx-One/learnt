<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function scopeUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeRole($query, $role_id)
    {
        return $query->where('role_id', $role_id);
    }

    public function scopeUserRole($query, $user_id, $role_id)
    {
        return $query->where('user_id', $user_id)->where('role_id', $role_id);
    }
}
