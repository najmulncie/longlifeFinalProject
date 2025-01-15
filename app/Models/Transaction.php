<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id',
    'amount',
    'status',
    'user_id',
    'payment_method',];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
