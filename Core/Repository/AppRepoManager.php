<?php 

namespace Core\Repository;

use Core\App;


class AppRepoManager
{

    //on importe le trait
    use RepositoryManagerTrait;

    public function __construct()
    {
        $config = App::getApp();   
    }
}
