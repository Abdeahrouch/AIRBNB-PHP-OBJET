<?php

namespace Core\View;

use App\Controller\AuthController;

class View
{
    // on définit le chemin absolu vers le dossier contenant les vues
    //on peut réutiliser les constantes de index.php
    public const PATH_VIEW = PATH_ROOT . 'views' . DS;
    // on récupere le chemin de notre dossiet _templates
    public const PATH_PARTIALS  = self::PATH_VIEW . '_templates' . DS;
    // on déclare une propriété titre
    public string $title = 'Titre par défaut';

    // on déclare notre constructeur
    public function __construct(
        private string $name,
        private bool $is_complete = true
    ) {
    }

    //on crée une méthode pour récupérer le chemin de la vue
    private function getRequirePath(): string
    {
        $arr_name = explode('/', $this->name);
        $category = $arr_name[0];
        $name = $arr_name[1];
        $name_prefix = $this->is_complete ? '' : '_';

        return self::PATH_VIEW . $category . DS . $name_prefix . $name . '.html.php';
    }

    //on crée une méthode pour afficher la vue
    public function render (?array $view_data = []): void
    {
        //on check ici si l'utilisateur est en session 
        //sinon on redirige vers la page de connexion
        $auth = AuthController::class;
        
        if(!empty($view_data)){
            extract($view_data);
        }
        //Mise en cache du résultat
        ob_start();
        //on import le template _header
        if($this->is_complete){
            require self::PATH_PARTIALS . '_header.html.php';
        }

        //on inclut le fichier de la vue
        require $this->getRequirePath();

        //on import le template _footer
        if($this->is_complete){
            require self::PATH_PARTIALS . '_footer.html.php';
        }
        //libération du cache
        ob_end_flush();
    }
}
