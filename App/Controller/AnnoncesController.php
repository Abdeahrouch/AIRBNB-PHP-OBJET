<?php

namespace App\Controller;

use App\Model\AnnoncesEquipement;
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

    public function detailAnnonce($id)
    {

        $annonce = AppRepoManager::getRm()->getAnnoncesRepository()->getAnnonceById($id);



        $data = [
            'title_tag' => 'Détails de l\'annonce',
            'h1_tag' => 'Détails de l\'annonce ' . $annonce->titre,
            'annonce' => $annonce
        ];


        $view = new View('annonces/detail');
        $view->render($data);
    }


    public function addBien()
    {



        $data = [
            'title_tag' => 'Ajouter un bien ',
            'h1_tag' => 'Ajouter un bien',
            'form_action' => '/process_bien.php',
            'typedelogements' => AppRepoManager::getRm()->getAnnoncesRepository()->getTypeDeLogement()
        ];


        $view = new View('annonces/bien');
        $view->render($data);
    }
}
