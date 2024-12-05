<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Middleware\XSS;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;

class RegisteredUserController extends Controller
{
    /**
     * Nombre maximum de tentatives d'inscription par IP
     */
    private const MAX_ATTEMPTS = 5;

    /**
     * Temps de blocage en minutes après dépassement des tentatives
     */
    private const DECAY_MINUTES = 60;

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Protection contre les attaques par force brute
        $key = 'registration_' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Trop de tentatives. Veuillez réessayer dans ' .
                    ceil(RateLimiter::availableIn($key) / 60) . ' minutes.']);
        }

        RateLimiter::hit($key, self::DECAY_MINUTES * 60);

        // Messages d'erreur personnalisés
        $messages = [
            'nom.required' => 'Le nom est requis',
            'nom.string' => 'Le nom doit être une chaîne de caractères',
            'nom.max' => 'Le nom ne peut pas dépasser :max caractères',
            'nom.regex' => 'Le nom contient des caractères non autorisés',

            'prenom.required' => 'Le prénom est requis',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères',
            'prenom.max' => 'Le prénom ne peut pas dépasser :max caractères',
            'prenom.regex' => 'Le prénom contient des caractères non autorisés',

            'email.required' => 'L\'adresse email est requise',
            'email.string' => 'L\'adresse email doit être une chaîne de caractères',
            'email.email' => 'L\'adresse email doit être une adresse email valide',
            'email.max' => 'L\'adresse email ne peut pas dépasser :max caractères',
            'email.unique' => 'Cette adresse email est déjà utilisée',

            'password.required' => 'Le mot de passe est requis',
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

        // Validation avec expressions régulières pour les noms
        $validator = Validator::make($request->all(), [
            'nom' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\s\-\']+$/u'
            ],
            'prenom' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\s\-\']+$/u'
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns,spoof',
                'max:255',
                'unique:'.User::class
            ],
            'password' => [
                'required',
                'string',
                'min:12',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]/'
            ],
        ], $messages);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Nettoyage XSS des entrées
        $nom = XSSClean::clean($request->nom);
        $prenom = XSSClean::clean($request->prenom);
        $email = XSSClean::clean($request->email);

        // Création de l'utilisateur avec les données nettoyées
        $user = User::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => Hash::make($request->password),
        ]);

        // Déclenche l'événement d'inscription
        event(new Registered($user));

        // Authentification de l'utilisateur
        Auth::login($user);

        // Régénération du jeton CSRF et de l'ID de session pour la sécurité
        $request->session()->regenerate();

        // Réinitialisation du rate limiter après succès
        RateLimiter::clear($key);

        return redirect(route('dashboard', absolute: false));
    }
}
