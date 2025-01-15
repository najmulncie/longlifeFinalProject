<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'link',
        'limit',
        'min_amount',
        'image',
        'description',
    ];

    // টোটাল খরচ গণনা করার জন্য একটি মেথড
    public function calculateTotalCost()
    {
        $this->total_cost = $this->limit * $this->min_amount;
        $this->save();
    }
}
