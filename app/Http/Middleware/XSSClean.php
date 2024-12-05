<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XSSProtection
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Protection contre le XSS via les headers
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://fonts.bunny.net; font-src 'self' https://fonts.bunny.net; img-src 'self' data:;");

        // Désactive le MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}

class XSSClean
{
    /**
     * Nettoie une chaîne de caractères des potentielles attaques XSS
     *
     * @param string $string
     * @return string
     */
    public static function clean($string)
    {
        if (!is_string($string)) {
            return $string;
        }

        // Supprime les caractères invisibles
        $string = preg_replace('/%0[0-8bcef]/', '', $string);
        $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

        // Conversion des caractères HTML
        $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

        // Supprime les scripts potentiels
        $string = preg_replace('/(javascript|vbscript|expression|applet|meta|xml|blink|link|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)/i', '', $string);

        // Supprime les événements OnXXX
        $string = preg_replace('/on\w+=/i', '', $string);

        // Supprime les balises malicieuses
        $string = strip_tags($string);

        return $string;
    }
}
