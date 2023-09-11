<?php

namespace Core\Repository;

use App\Model\Repository\AnnoncesRepository;
use Core\App;


class AppRepoManager
{
    //je declare une propriete qui va contenit l instance de ma classe
    private AnnoncesRepository $annoncesRepository;

    //on importe le trait
    use RepositoryManagerTrait;

    //je cree le getter de Annoncesrepository
    public function getAnnoncesRepository(): AnnoncesRepository
    {
        return $this->annoncesRepository;
    }


    //le constructeur
    public function __construct()
    {
        $config = App::getApp();
        $this->annoncesRepository = new AnnoncesRepository($config);
    }
}
