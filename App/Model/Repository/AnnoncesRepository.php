<?php

namespace App\Model\Repository;

use PDO;
use App\Model\Annonces;
use App\Model\Photos;
use Core\Repository\AppRepoManager;
use Core\Repository\Repository;

class AnnoncesRepository extends Repository
{

    // Je retourne le nom de la table associée à ce repo.
    public function getTableName(): string
    {
        return 'annonces';
    }

    // Je récupère ttes les annonces et je les retourne.
    public function getAllAnnonces()
    {
        return $this->readAll(Annonces::class);
    }

    // Je récupère toutes les annonces pour les mettre en relation avecs les photos
    public function getAnnoncesByImage()
    {
        $annonces = $this->getAllAnnonces();
        foreach ($annonces as $bien) {

            $photo = AppRepoManager::getRm()->getPhotosRepository()->getPhotos($bien->id);
            $bien->photo = $photo;

            $array_bien[] = $bien;
        }
        //je retourne les annonces avec les photos
        return $array_bien;
    }

    // Je récupère toutes les annonces.
    public function findAll(): array
    {
        return $this->readAll(Annonces::class);
    }

    // 
    public function getAnnonceById($id)
    {
        $query = "SELECT * FROM annonces WHERE id = :id";
        $annonce_id = [':id' => $id];

        //  la requette pour recuper
        $stmt = $this->pdo->prepare($query);

        $stmt->execute($annonce_id);

        $row_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row_data) {

            // Je crée un objet Annonces avec les données récupérées.
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

            // J'associe les photos à l'annonce.
            $annonce->photo = AppRepoManager::getRm()->getPhotosRepository()->getPhotos($annonce->id);

            // Je retourne l'annonce.
            return $annonce;
        }
    }

    // Je récupère les types de logement depuis la base de données.
    public function getTypeDeLogement()
    {
        $sql = "SELECT * FROM type_de_logement";

        $stmt = $this->pdo->query($sql);

        $typeDeLogement = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $typeDeLogement;
    }

    // J'ajout une nouvelle annonce dans la base de données avec les données 

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

    // Je récupère les annonces créées par un user
    public function getMesAnnonces($user_id)
    {
        $requete = "SELECT * FROM annonces WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($requete);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $annonces = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $annonces;
    }

    // Je supprime une annonce par son id
    public function getdeleteAnnonce(int $annonce_id): bool
    {
        return $this->delete($annonce_id);
    }
}
