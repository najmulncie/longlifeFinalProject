<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'referred_by',
        'name',
        'selling_price',
        'gmail',
        'is_approved',
        'terms_accepted',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
