<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'initial_cost',
        'selling_price',
    ];
    protected $table = 'premiums'; 

   
}
