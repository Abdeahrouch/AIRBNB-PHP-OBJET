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
}
