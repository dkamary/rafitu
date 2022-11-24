<?php

namespace App\Models\Managers;

class DateManager
{
    const SEMAINES = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    const MOIS = [1 => 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    
    public static function dateFr($date): string
    {
        if (!($date instanceof \DateTime)) {
            return (string)$date;
        }
        
        return sprintf(
            '%s %d %s %d', 
            self::SEMAINES[$date->format('w')], 
            (int)$date->format('d'), 
            self::MOIS[(int)$date->format('m')],
            (int)$date->format('Y')
        );
    }
}
