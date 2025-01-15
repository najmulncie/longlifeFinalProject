<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'professional_service_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function professionalService()
    {
        return $this->belongsTo(ProfessionalService::class);
    }
}
