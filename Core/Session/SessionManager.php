<?php 

namespace Core\Session;

abstract class SessionManager
{
    //Pour pouvoir alimenter notre session
    public static function set (string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    // pour pour récupérer notre session
    public static function get (string $key)
    {
        //?? = racourci de ternaire soit il renvoit la session sois il renvoit null= rien
        return $_SESSION[$key] ?? null;
    }

    // pour supprimer notre session
    public static function remove (string $key):void
    {
        // si j'essaye de supprimer une session qui nexiste pas, je ne fais rien
        if(!self::get($key))return;
        // sinon je supprime la session 
        unset($_SESSION[$key]);

    }
}