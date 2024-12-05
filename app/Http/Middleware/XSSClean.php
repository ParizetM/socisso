<?php

namespace App\Http\Middleware;

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
