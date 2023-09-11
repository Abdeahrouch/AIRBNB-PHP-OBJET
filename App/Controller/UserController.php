<?php

namespace App\Controller;



use Core\View\View;
use Core\Controller\Controller;
use Core\Repository\AppRepoManager;



class UserController extends Controller
{
    public function inscription()

    {
        //On récupère la liste des utilisateurs
        //on reconstruit le tableau de données
        $view_data = [
            'title_tag' => 'AIRBNB',
            'h1_tag' => 'Liste des utilisateurs'
        ];

        $view = new View('user/inscription');
        $view->render($view_data);
    }

    public function login()
    {
        $view_data = [
            'title_tag' => 'AIRBNB',
            'h1_tag' => 'Liste des utilisateurs'
        ];

        $view = new View('user/login');
        $view->render($view_data);
    }
}
