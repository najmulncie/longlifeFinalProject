<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bill_no',
        'mobile_number',
        'operator',
        'total_bill',
        'address',
         'status', 
         'cashback'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
