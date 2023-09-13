<?php

namespace Core\Repository;

use Core\App;
use App\Model\Repository\PhotoRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\AnnoncesRepository;


class AppRepoManager
{
    //je declare une propriete qui va contenit l instance de ma classe
    private AnnoncesRepository $annoncesRepository;

    private PhotoRepository $photoRepository;

    private UserRepository $userRepository;


    //on importe le trait
    use RepositoryManagerTrait;



    //je cree le getter de Annoncesrepository
    public function getAnnoncesRepository(): AnnoncesRepository
    {
        return $this->annoncesRepository;
    }


    //je cree le getter de UserRepository
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    public function getPhotosRepository(): PhotoRepository
    {
        return $this->photoRepository;
    }



    //le constructeur
    public function __construct()
    {
        $config = App::getApp();
        $this->annoncesRepository = new AnnoncesRepository($config);
        $this->userRepository = new UserRepository($config);
        $this->photoRepository = new PhotoRepository($config);
    }
}
