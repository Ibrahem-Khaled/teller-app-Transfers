<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'phone',
        'address',
        'role',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function courses()
    {
        return $this->hasMany(Courses::class, 'teacher_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function userCourses()
    {
        return $this->belongsToMany(Courses::class, 'user_courses', 'user_id', 'course_id')
            ->withTimestamps();
    }


    public function getRoleNameAttribute()
    {
        return trans('roles.' . $this->role);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? trans('general.active') : trans('general.inactive');
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('assets/img/avatar-male.jpeg');
    }
}
