<?php

namespace App\Model\Repository;


use PDO;
use App\Model\Annonces;
use Core\Repository\Repository;

class AnnoncesRepository extends Repository
{

    public function getTableName(): string
    {
        return 'annonces';
    }


    public function getAllAnnonces()
    {
        return $this->readAll(Annonces::class);
    }


    public function getAnnoncesByImage()
    {
        $q = 'SELECT annonces.id, annonces.titre, annonces.pays, annonces.ville, annonces.adresse, annonces.type_de_logement_id, 
    annonces.taile, annonces.nbr_de_pieces, annonces.description, annonces.prix_par_nuit, annonces.nbr_de_couchages, photos.image_path
    FROM annonces
    INNER JOIN photos ON annonces.id = photos.annonces_id';

        $stmt = $this->pdo->query($q);

        if (!$stmt) {
            return null;
        }

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        var_dump($results);
        return $results;
    }


    public function findAll(): array
    {
        return $this->readAll(Annonces::class);
    }
}
