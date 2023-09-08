<?php

namespace App\Model;

use Core\Model\Model;

class Annonces extends Model

{
    public int $user_id;
    public string $titre;
    public string $pays;
    public string $ville;
    public string $adresse;
    public int $typeDeLogement_id;
    public int $taille;
    public int $nbrDePieces;
    public string $description;
    public int $prixParNuit;
    public int $nbrDeCouchages;
}
