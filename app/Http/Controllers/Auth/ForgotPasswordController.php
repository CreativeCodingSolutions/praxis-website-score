<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a password reset link to the given email.
     *
     * DSGVO-compliant: Always returns the same success message regardless
     * of whether the email exists in the database. This prevents user
     * enumeration attacks and is required under GDPR/DSGVO.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // DSGVO: Always show the same message whether the email exists or not.
        // This prevents revealing which emails are registered in the system.
        return back()->with('status', __(
            $status === Password::RESET_LINK_SENT
                ? 'passwords.sent'
                : 'passwords.sent'
        ));
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * DSGVO-compliant: Invalid/expired tokens return a generic error
     * without revealing whether the email exists.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Passwort wurde erfolgreich zurückgesetzt! Sie können sich jetzt anmelden.');
        }

        // DSGVO: Generic error — don't reveal if email exists or token specifics
        return back()->withErrors([
            'email' => 'Der Link ist ungültig oder abgelaufen. Bitte fordern Sie einen neuen an.',
        ]);
    }
}
