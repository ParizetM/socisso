<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $messages = [
            'token.required' => 'Le jeton de réinitialisation est requis',

            'email.required' => 'L\'adresse email est requise',
            'email.email' => 'L\'adresse email doit être une adresse email valide',

            'password.required' => 'Le nouveau mot de passe est requis',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères',
            'password.min' => 'Le mot de passe doit faire au moins :min caractères',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'password.regex' => [
                '/[a-z]/' => 'Le mot de passe doit contenir au moins une minuscule',
                '/[A-Z]/' => 'Le mot de passe doit contenir au moins une majuscule',
                '/[0-9]/' => 'Le mot de passe doit contenir au moins un chiffre',
                '/[@$!%*#?&]/' => 'Le mot de passe doit contenir au moins un caractère spécial (@$!%*#?&)'
            ]
        ];

        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'
            ],
        ], $messages);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Votre mot de passe a été réinitialisé avec succès.');
        }

        $statusMessages = [
            'passwords.token' => 'Ce lien de réinitialisation n\'est pas valide ou a expiré.',
            'passwords.user' => 'Nous ne trouvons pas d\'utilisateur avec cette adresse email.',
            'passwords.throttled' => 'Veuillez patienter avant de réessayer.',
            'default' => 'Une erreur est survenue lors de la réinitialisation du mot de passe.'
        ];

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $statusMessages[$status] ?? $statusMessages['default']]);
    }
}
