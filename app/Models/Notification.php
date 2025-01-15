<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'is_active'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')
            ->withPivot('is_seen')
            ->withTimestamps();
    }

}
