<?php

namespace App\Model;

use Core\Model\Model;

class Reservation extends Model

{
    public int $user_id;
    public int $annonces_id;
    public int $date_debut;
    public int $date_fin;
    public int $nbrDePersonnes;
}
