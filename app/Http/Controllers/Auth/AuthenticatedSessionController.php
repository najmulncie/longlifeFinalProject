<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = ''; // Default URL

        if ($request->user()) {
            if ($request->user()->role === 'admin') {
                $url = '/admin/dashboard';
            } elseif ($request->user()->role === 'user') {
                $url = '/dashboard';
            } else {
                // Handle unexpected role
                // You might want to log this or redirect to an error page
            }
        } else {
            // Handle the case where user is not authenticated
            // You might want to redirect to login page or handle accordingly
        }


// Check if the user is accessing the admin dashboard
    if ($url === '/admin/dashboard' && $request->user()->role !== 'admin') {
        // Redirect the user to their appropriate dashboard or handle unauthorized access
        // For example:
        $url = '/dashboard'; // Redirect to user dashboard
    }
    
    $notification = array(
        'message' => 'Login Successfully!',
        'alert-type' => 'success',
    );
    return redirect()->intended($url)->with($notification);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
