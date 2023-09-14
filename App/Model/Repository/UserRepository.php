<?php

namespace App\Model\Repository;

use App\Model\User;
use Core\Repository\Repository;
use DateTime;

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



    public function createUser(string $email, string $password, int $is_hote, string $nom, string $prenom)
    {
        $date_inscription = time();
        $q_select = sprintf(
            'SELECT * FROM `%s` WHERE `email` = :email',
            $this->getTableName()
        );

        $stmt_select = $this->pdo->prepare($q_select);

        if (!$stmt_select) return null;

        $stmt_select->execute([
            'email' => $email
        ]);

        $user_data = $stmt_select->fetch();

        if (!empty($user_data)) return null;

        $q_insert = sprintf(
            'INSERT INTO `%s` (`password`, `is_hote`, `nom`, `prenom`, `date_inscription`, `email`) 
        VALUES (:password, :is_hote, :nom, :prenom, :date_inscription, :email)',
            $this->getTableName()
        );

        $stmt_insert = $this->pdo->prepare($q_insert);

        if (!$stmt_insert) return null;

        $stmt_insert->execute([
            'password' => $password,
            'is_hote' => $is_hote,
            'nom' => $nom,
            'prenom' => $prenom,
            'date_inscription' => $date_inscription,
            'email' => $email
        ]);

        $user_id = $this->pdo->lastInsertId();

        $select_user = sprintf(
            'SELECT * FROM `%s` WHERE `id` = :id',
            $this->getTableName()
        );

        $stmt_user = $this->pdo->prepare($select_user);

        if (!$stmt_user) return null;

        $stmt_user->execute([
            'id' => $user_id
        ]);

        $user = $stmt_user->fetch();

        return empty($user) ? null : new User($user);
    }
}
