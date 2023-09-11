<?php

namespace App\Model\Repository;


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

    public function findAll(): array
    {
        return $this->readAll(Annonces::class);
    }
}
