<?php

namespace Core\Database;

use PDO;
//design pattern singleton (ne peut être instancié qu'une seule fois)


class Database
{
    private static ?PDO $pdoInstance = null;

    private const PDO_OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    //on crée une méthode statique qui va nous permettre de récuérer une instance de PDO
    // on lui passe en parametre une instance de Database ConfigInterface
    public static function getPDO(DatabaseConfigInterface $config): PDO
    {
        // si l'instance de PDO n'a jamais été instanciée, on la crée
        if (is_null(self::$pdoInstance)) {
            //$dsn = 'mysql:dbname=site_mvc;host=datebase';
            $dns = sprintf('mysql:dbname=%s;host=%s', $config->getName(), $config->getHost());
            self::$pdoInstance = new PDO(
                $dns,
                $config->getUser(), //ici les info de l'utilisateur
                $config->getPass(), // ici le mot de passe
                self::PDO_OPTIONS
            );
        }
        return self::$pdoInstance;
    }

    //on déclare le constructeur en privte pour bloquer l'instanciation de la classe
    private function __construct()
    {
    }
    //on déclare la methode clone en private pour bloquer le clonage de la classe
    private function __clone()
    {
    }
    //on déclare la methode wakeup en private pour bloquer la deserialization de la classe
    public function __wakeup()
    {
    }
}
