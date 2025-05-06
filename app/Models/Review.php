<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'content',
        'rating',
        'is_approved'
    ];

    /**
     * العلاقة مع نموذج User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع نموذج Course
     */
    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}
