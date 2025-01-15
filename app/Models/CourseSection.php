<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'video_url', 'category_id'];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
