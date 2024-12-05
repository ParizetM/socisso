<?php

return [
    'required' => [
        'email' => 'L\'adresse email est requise',
        'password' => 'Le mot de passe est requis',
        'nom' => 'Le nom est requis',
        'prenom' => 'Le prénom est requis',
        'default' => 'Le champ :attribute est requis'
    ],

    'email' => 'L\'adresse email doit être une adresse email valide',
    'unique' => [
        'email' => 'Cette adresse email est déjà utilisée',
        'default' => 'La valeur du champ :attribute est déjà utilisée'
    ],

    'min' => [
        'password' => 'Le mot de passe doit faire au moins :min caractères',
        'string' => 'Le champ :attribute doit contenir au moins :min caractères'
    ],

    'max' => [
        'nom' => 'Le nom ne peut pas dépasser :max caractères',
        'prenom' => 'Le prénom ne peut pas dépasser :max caractères',
        'email' => 'L\'adresse email ne peut pas dépasser :max caractères',
        'string' => 'Le champ :attribute ne peut pas dépasser :max caractères'
    ],

    'confirmed' => 'La confirmation du mot de passe ne correspond pas',
    'current_password' => 'Le mot de passe actuel est incorrect',
    'string' => 'Le champ :attribute doit être une chaîne de caractères',
    'lowercase' => 'Le champ :attribute doit être en minuscules',

    'password' => [
        'mixed' => 'Le mot de passe doit contenir au moins une majuscule et une minuscule',
        'letters' => 'Le mot de passe doit contenir au moins une lettre',
        'numbers' => 'Le mot de passe doit contenir au moins un chiffre',
        'symbols' => 'Le mot de passe doit contenir au moins un caractère spécial',
    ],

    'custom' => [
        'password' => [
            'regex' => [
                '/[a-z]/' => 'Le mot de passe doit contenir au moins une minuscule',
                '/[A-Z]/' => 'Le mot de passe doit contenir au moins une majuscule',
                '/[0-9]/' => 'Le mot de passe doit contenir au moins un chiffre',
                '/[@$!%*#?&]/' => 'Le mot de passe doit contenir au moins un caractère spécial (@$!%*#?&)',
            ],
            'different' => 'Le nouveau mot de passe doit être différent de l\'ancien',
        ],
        'email' => [
            'exists' => 'Aucun compte n\'existe avec cette adresse email',
        ],
    ],

    'attributes' => [
        'email' => 'adresse email',
        'password' => 'mot de passe',
        'nom' => 'nom',
        'prenom' => 'prénom',
        'current_password' => 'mot de passe actuel',
    ],
];
