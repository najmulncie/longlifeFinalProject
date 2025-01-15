<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\EmergencyAlert;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //$emergency_alerts = EmergencyAlert::all(); // Retrieve all emergency alerts

        // $view->with('emergency_alerts', $emergency_alerts);

        // সক্রিয় নোটিফিকেশনগুলো শেয়ার করা
        View::composer('*', function ($view)  {
            if (Auth::check()) {
                $notifications = Auth::user()->notifications()
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

                $unseenCount = Auth::user()->notifications()->wherePivot('is_seen', false)->count();

                $view->with([
                    'headerNotifications' => $notifications,
                    'unseenCount' => $unseenCount,
                ]);
            }
        });
    }
}
