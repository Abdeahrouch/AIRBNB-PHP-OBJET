<?php

namespace App\Controller;

use Core\View\View;
use Core\Controller\Controller;
use Core\Repository\AppRepoManager;

class AnnoncesController extends Controller
{
    public function index()
    {
        //tableau de données à envoyer à la vue
        $data = [
            'title_tag' => 'AIRBNB',
            'h1_tag'  => 'ACCUEIL',
            'annonces' => AppRepoManager::getRm()->getAnnoncesRepository()->getAnnoncesByImage()

        ];

        $view = new View('annonces/index');

        $view->render($data);
    }
}
