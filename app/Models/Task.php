<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'amount', 'link'];

    // ইউজারের সাথে সম্পর্ক
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Task.php
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('completed_at')->withTimestamps();
    }
}
