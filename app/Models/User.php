<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable // implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //protected $fillable = ['user_id', 'referral_code']; // Adjust according to your fields

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->referral_code = Str::upper(Str::random(6)); // ৬ ডিজিটের কোড
        });
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by', 'id');
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }


    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    // level কমিশন হিসাবের জন্য
    public function calculateReferralEarnings()
    {
        $levels = [29, 10, 5, 3, 2]; // লেভেল অনুযায়ী কমিশন
        $this->addReferralEarnings($this, $levels, 0);
    }

    private function addReferralEarnings($user, $levels, $level)
    {
        if ($level >= count($levels)) {
            return;
        }

        $referrals = $user->referrals; // রেফারেল ইউজারদের সংগ্রহ করুন

        foreach ($referrals as $referral) {
            // কমিশন যোগ করুন
            $amount = $levels[$level];
            $referral->main_balance += $amount;
            $referral->save();

            // রিকর্শন কল করুন
            $this->addReferralEarnings($referral, $levels, $level + 1);
        }
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('completed_at')->withTimestamps();
    }
    
    public function billPayments()
    {
        return $this->hasMany(BillPayment::class, 'user_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_user')
            ->withPivot('is_seen')
            ->withTimestamps();
    }

}
