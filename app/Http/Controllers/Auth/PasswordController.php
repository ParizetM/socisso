<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $messages = [
            'current_password.required' => 'Le mot de passe actuel est requis',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect',

            'password.required' => 'Le nouveau mot de passe est requis',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères',
            'password.min' => 'Le mot de passe doit faire au moins :min caractères',
            'password.confirmed' => 'La confirmation du nouveau mot de passe ne correspond pas',
            'password.different' => 'Le nouveau mot de passe doit être différent de l\'ancien',
            'password.regex' => [
                '/[a-z]/' => 'Le mot de passe doit contenir au moins une minuscule',
                '/[A-Z]/' => 'Le mot de passe doit contenir au moins une majuscule',
                '/[0-9]/' => 'Le mot de passe doit contenir au moins un chiffre',
                '/[@$!%*#?&]/' => 'Le mot de passe doit contenir au moins un caractère spécial (@$!%*#?&)'
            ]
        ];

        // Utilisation de Validator pour avoir un contrôle plus précis sur la validation
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'different:current_password',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]/'
            ],
        ], $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors(), 'updatePassword')
                ->withInput();
        }

        $validated = $validator->validated();

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
