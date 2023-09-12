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


    public function checkAuth(string $email, string $password)
    {
        $query = sprintf(
            'SELECT * FROM %s WHERE email = :email  AND password = :password',
            $this->getTableName()
        );

        //je prepare la requete
        $stmt = $this->pdo->prepare($query);
        //je verifie que la requete est bien preparee
        if (!$stmt) return null;
        //j  execute la requete
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);

        //je recupere les donnes 
        $user_data = $stmt->fetch();
        var_dump($user_data);die();
        
        //j instancie un objet User
        return empty($user_data) ? null : new User($user_data);
    }













    public function getAllUsers()
    {
        return $this->readAll(User::class);
    }

    public function findAll(): array
    {
        return $this->readAll(User::class);
    }
}
















