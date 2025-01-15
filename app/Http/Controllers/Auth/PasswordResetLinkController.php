<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $notification = Password::sendResetLink(
            $request->only('email')
        );

        $notification = array(
            'message' => 'Password Link Send Successfully! You will check your email',
            'alert-type' => 'success',
        );
        // return back()->with($notification);
        return $notification == Password::RESET_LINK_SENT
                    ? back()->with($notification)
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => $notification]);
    }
}
