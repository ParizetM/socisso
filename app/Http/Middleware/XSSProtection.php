<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XSSProtection
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->input();

        // Parcours des champs pour nettoyer les valeurs
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = str_replace(['\'', '"', '<', '>'], '', $value);
            }
        });

        // Mise à jour de la requête avec les données nettoyées
        $request->merge($input);

        return $next($request);
    }
}
