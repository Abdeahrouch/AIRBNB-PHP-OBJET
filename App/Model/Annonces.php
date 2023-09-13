<?php

namespace App\Model;

use App\Model\Photos;
use Core\Model\Model;

class Annonces extends Model
{
    public int $user_id;
    public string $titre;
    public string $pays;
    public string $ville;
    public string $adresse;
    public int $type_de_logement_id;
    public int $taile;
    public int $nbr_de_pieces;
    public string $description;
    public int $prix_par_nuit;
    public int $nbr_de_couchages;
    public array $photo = [];
}
