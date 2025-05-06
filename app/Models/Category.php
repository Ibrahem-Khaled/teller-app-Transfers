<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    public function getStatusAttribute()
    {
        return $this->deleted_at ? 'محذوف' : 'نشط';
    }

    public function getStatusClassAttribute()
    {
        return $this->deleted_at ? 'danger' : 'success';
    }
    public function courses()
    {
        return $this->hasMany(Courses::class, 'category_id', 'id');
    }
}
