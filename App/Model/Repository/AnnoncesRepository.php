<?php

namespace App\Model\Repository;


use PDO;
use App\Model\Annonces;
use App\Model\Photos;
use Core\Repository\AppRepoManager;
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
        $annonces = $this->getAllAnnonces();
        foreach ($annonces as $bien) {

            $photo = AppRepoManager::getRm()->getPhotosRepository()->getPhotos($bien->id);
            $bien->photo = $photo;

            $array_bien[] = $bien;
        }
        return $array_bien;
    }


    public function findAll(): array
    {
        return $this->readAll(Annonces::class);
    }


    public function getAnnonceById($id)
    {
        $query = "SELECT * FROM annonces WHERE id = :id";
        $annonce_id = [':id' => $id];

        // Préparez la requête SQL
        $stmt = $this->pdo->prepare($query);

        $stmt->execute($annonce_id);

        $row_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row_data) {


            $annonce = new Annonces();
            $annonce->id = $row_data['id'];
            $annonce->user_id = $row_data['user_id'];
            $annonce->titre = $row_data['titre'];
            $annonce->pays = $row_data['pays'];
            $annonce->ville = $row_data['ville'];
            $annonce->adresse = $row_data['adresse'];
            $annonce->type_de_logement_id = $row_data['type_de_logement_id'];
            $annonce->taile = $row_data['taile'];
            $annonce->nbr_de_pieces = $row_data['nbr_de_pieces'];
            $annonce->description = $row_data['description'];
            $annonce->prix_par_nuit = $row_data['prix_par_nuit'];
            $annonce->nbr_de_couchages = $row_data['nbr_de_couchages'];


            $annonce->photo = AppRepoManager::getRm()->getPhotosRepository()->getPhotos($annonce->id);

            return $annonce;
        }
    }

    public function getTypeDeLogement()
    {
        $sql = "SELECT * FROM type_de_logement";

        $stmt = $this->pdo->query($sql);

        $typeDeLogement = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $typeDeLogement;
    }



    public function getCreationAnnonce(array $data)
    {

        $requete_add_annonce = sprintf(
            'INSERT INTO `annonces` (`user_id`, `titre`, `pays`, `ville`, `adresse`, `type_de_logement_id`, `taile`, `nbr_de_pieces`, `description`, `prix_par_nuit`, `nbr_de_couchages`) 
            VALUES (:user_id, :titre, :pays, :ville, :adresse, :type_de_logement_id, :taile, :nbr_de_pieces, :description, :prix_par_nuit, :nbr_de_couchages)'
        );

        $stmt = $this->pdo->prepare($requete_add_annonce);

        if (!$stmt) {
            return false;
        }


        $stmt->execute($data);
    }
}
