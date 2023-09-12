<?php

namespace App\Model\Repository;

use App\Model\User;
use Core\Repository\Repository;



class UserRepository extends Repository
{
    public function getTableName(): string
    {
        return 'user';
    }

    public function checkAuth(string $email, string $password): ?User
    {
        //on crée la requete
        $query = sprintf(
            'SELECT * FROM `%s` WHERE `email` = :email AND `password` = :password',
            $this->getTableName()
        );
        //on prépare la requete
        $stmt = $this->pdo->prepare($query);
        //on verifie que la requete est bien préparée
        if (!$stmt) return null;
        //on execute la requete
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);
        //on récupère les données
        $user_data = $stmt->fetch();

        //on instancie un objet User
        return empty($user_data) ? null : new User($user_data);
    }

    //crée une méthode qui récupère la liste des utilisateurs
    public function findAll(): array
    {
        return $this->readAll(User::class);
    }

    //méthode qui récupère un utilisateur par son id
    public function findById(int $id): ?User
    {
        return $this->readById(User::class, $id);
    }

    //méthode qui update l'utilisateur
    public function updateUserById(string $email, int $role, int $id): ?User
    {
        //on crée la requete
        $q = sprintf(
            'UPDATE `%s` SET `email` = :email, `role` = :role WHERE `id` = :id',
            $this->getTableName()
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);
        //on verifie que la requete est bien préparée
        if (!$stmt) return null;
        //on execute la requete
        $stmt->execute([
            'email' => $email,
            'role' => $role,
            'id' => $id
        ]);
        //on récupère les données
        $user_data = $stmt->fetch();

        //on instancie un objet User
        return empty($user_data) ? null : new User($user_data);
    }

    //méthode pour supprimer un utilisateur
    public function deleteUser(int $id): bool
    {
        return $this->delete($id);
    }

    //méthode pour créer un nouvel utilisateur
    public function createUser(string $email, string $password, int $role)
    {
        //on crée la requete d'insertion
        $q_insert = sprintf(
            'INSERT INTO `%s` (`email`, `password`, `role`) 
            VALUES (:email, :password, :role)',
            $this->getTableName()
        );
        //on crée une requete pour savoir si un utilisateur existe déjà
        $q_select = sprintf(
            'SELECT * FROM `%s` WHERE `email` = :email',
            $this->getTableName()
        );
        //on prépare la requete select
        $stmt_select = $this->pdo->prepare($q_select);
        //on verifie que la requete est bien préparée
        if (!$stmt_select) return false;
        //on execute la requete select
        $stmt_select->execute([
            'email' => $email
        ]);
        //on récupère les données
        $user_data = $stmt_select->fetch();
        //si j'ai un resultat je retourne false
        if (!empty($user_data)) return false;
        //sinon on prépare la requete d'insertion
        $stmt_insert = $this->pdo->prepare($q_insert);
        //on verifie que la requete est bien préparée
        if (!$stmt_insert) return false;
        //on execute la requete d'insertion
        $stmt_insert->execute([
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);
        //on retourne true
        return true;
    }
}
