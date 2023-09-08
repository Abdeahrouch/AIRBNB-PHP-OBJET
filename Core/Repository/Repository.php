<?php 

namespace Core\Repository;

use PDO;
use Core\Database\Database;
use Core\Database\DatabaseConfigInterface;
use Core\Model\Model;

abstract class Repository 
{
    protected PDO $pdo;

    abstract public function getTableName(): string;

    public function __construct(DatabaseConfigInterface $config)
    {
        $this->pdo = Database::getPDO($config);
    }

    protected function readAll(string $class_name): array
    {
        //on déclare un tableau vide
        $arr_result = [];
        //on crée la requete
        $q = sprintf("SELECT * FROM %s", $this->getTableName());
        //on éxecute la requete
        $stmt = $this->pdo->query($q);
        // si la requete nest pas valide on retourn le tableau vide
        if(!$stmt) return $arr_result;
        //on boucle sur les données de la requete
        while($row_data = $stmt->fetch()){
            //on stocke dans $arr_result un nouvel objet de la classe $class_name
            $arr_result[] = new $class_name($row_data);
        }
        //:on retourne le tableau 
        return $arr_result;
    }

    protected function readById(string $class_name, int $id): ?Model
    {
    
        //on crée la requete
        $q = sprintf("SELECT * FROM %s WHERE id = :id", $this->getTableName());
        //on prépare la requete
        $stmt = $this->pdo->prepare($q);
        // si la requete nest pas valide on retourn le tableau vide
        if(!$stmt) return null;

        //on execute la requete
        $stmt->execute(['id' => $id]);
        // on recupere les results
        $row_data = $stmt->fetch();
        
        return !empty($row_data) ? new $class_name($row_data) : null;
    }

    protected function delete(int $id): bool
    {

        $q= sprintf("DELETE FROM %s WHERE id = :id", $this->getTableName());
        $stmt = $this->pdo->prepare($q);
        if(!$stmt) return false;
        $stmt->execute(['id' => $id]);
        return true;
    }

    
}