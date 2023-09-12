<?php

namespace App\Model;

use Core\Model\Model;

class User extends Model

{


    public string $password;
    public  bool $is_hote;
    public string $nom;
    public string $prenom;
    public int $date_inscription;
    public string $email;


}
