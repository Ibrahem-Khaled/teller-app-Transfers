<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'teacher_id',
        'name',
        'description',
        'thumbnail',
        'duration',
        'level',
        'language',
        'price',
        'discount'
    ];

    protected $casts = [
        'duration' => 'datetime:H:i:s',
    ];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id')->orderBy('order', 'asc');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id');
    }
    // public function userCourses()
    // {
    //     return $this->hasMany(UserCourse::class);
    // }

    public function getFinalPriceAttribute()
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }

    public function getStatusAttribute()
    {
        return $this->deleted_at ? 'محذوف' : 'نشط';
    }

    public function getStatusClassAttribute()
    {
        return $this->deleted_at ? 'danger' : 'success';
    }

    public function getLevelNameAttribute()
    {
        $levels = [
            'beginner' => 'مبتدئ',
            'intermediate' => 'متوسط',
            'advanced' => 'متقدم'
        ];
        return $levels[$this->level] ?? $this->level;
    }

    public function getAvgRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getIsNewAttribute()
    {
        return $this->created_at->diffInDays(now()) <= 7;
    }
}
