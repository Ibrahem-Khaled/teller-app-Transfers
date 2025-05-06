<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video_path',
        'thumbnail',
        'views',
        'status',
        'type',
        'order',
        'is_free'
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'video_id')->latest();
    }

    public function resources()
    {
        return $this->hasMany(VideoResource::class, 'video_id')->latest();
    }


    public function getStatusNameAttribute()
    {
        return [
            'active' => 'نشط',
            'inactive' => 'غير نشط'
        ][$this->status] ?? $this->status;
    }

    public function getTypeNameAttribute()
    {
        return [
            'video' => 'فيديو',
            'audio' => 'صوت'
        ][$this->type] ?? $this->type;
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('img/default-video-thumbnail.jpg');
    }
}
