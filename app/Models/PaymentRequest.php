<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'mobile_number',
        'status',
    ];

    // ইউজারের সাথে সম্পর্ক (one-to-many relationship)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
