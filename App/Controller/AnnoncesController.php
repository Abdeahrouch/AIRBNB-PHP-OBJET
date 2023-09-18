<?php

namespace App\Controller;

use Core\View\View;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Controller\Controller;
use App\Model\AnnoncesEquipement;
use Core\Repository\AppRepoManager;
use Laminas\Diactoros\ServerRequest;

class AnnoncesController extends Controller
{
    // méthode qui affiche la page d'accueil avec toutes les annonces.
    public function index()
    {
        // Tableau de données à envoyer à la vue.
        $data = [
            'title_tag' => 'AIRBNB',
            'h1_tag'  => 'ACCUEIL ABDES AIRBNB',
            'annonces' => AppRepoManager::getRm()->getAnnoncesRepository()->getAnnoncesByImage()
        ];

        $view = new View('annonces/index');

        $view->render($data);
    }

    // Je cree la méthode qui affiche les détails d'une annonce.
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

    // je cree  la méthode qui affiche le formulaire pour ajouter un bien.
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

    // Je cree une methode pour que l user puisse crees des  annonce.
    public function addAnnonces(ServerRequest $request)
    {
        $post_data = $request->getParsedBody();
        $user = $_SESSION['USER'];

        $user = $user->id;

        $image_data = $_FILES['images'];
        $form_result = new FormResult();

        // Condition pour restreindre les types de fichiers image 
        if (
            $image_data['type'] !== 'image/jpeg' &&
            $image_data['type'] !== 'image/png' &&
            $image_data['type'] !== 'image/jpg' &&
            $image_data['type'] !== 'image/webp'
        ) {
            $form_result->addError(new FormError('Le format de l\'image n\'est pas valide'));
        } else if (
            //verification de si champs sont vides
            empty($post_data['titre']) ||
            empty($post_data['pays']) ||
            empty($post_data['ville']) ||
            empty($post_data['adresse']) ||
            empty($post_data['type_de_logement']) ||
            empty($post_data['taile']) ||
            empty($post_data['nbr_de_pieces']) ||
            empty($post_data['description']) ||
            empty($post_data['prix_par_nuit']) ||
            empty($post_data['nbr_de_couchages'])
        ) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        } else {
            
            $user_id = $user;
            $titre = htmlspecialchars(trim($post_data['titre']));
            $pays = htmlspecialchars(trim($post_data['pays']));
            $ville = htmlspecialchars(trim($post_data['ville']));
            $adresse = htmlspecialchars(trim($post_data['adresse']));
            $type_de_logement_id = intval($post_data['type_de_logement']);
            $taile = intval($post_data['taile']);
            $nbr_de_pieces = intval($post_data['nbr_de_pieces']);
            $description = htmlspecialchars(trim($post_data['description']));
            $prix_par_nuit = floatval($post_data['prix_par_nuit']);
            $nbr_de_couchages = intval($post_data['nbr_de_couchages']);

            // mecanique pour grer le telechargment des images
            $imgTmpPath = $image_data['tmp_name'];
            $filename = uniqid() . '_' . $image_data['name'];
            $imgPathPublic = PATH_ROOT . '/public/img/' . $filename;

            $data = [
                'user_id' => $user_id,
                'titre' => $titre,
                'pays' => $pays,
                'ville' => $ville,
                'adresse' => $adresse,
                'type_de_logement_id' => $type_de_logement_id,
                'taile' => $taile,
                'nbr_de_pieces' => $nbr_de_pieces,
                'description' => $description,
                'prix_par_nuit' => $prix_par_nuit,
                'nbr_de_couchages' => $nbr_de_couchages,
            ];

            if (move_uploaded_file($imgTmpPath, $imgPathPublic)) {
                AppRepoManager::getRm()->getAnnoncesRepository()->getCreationAnnonce($data);
            } else {
                $form_result->addError(new FormError('Erreur lors de l\'upload de l\'image'));
            }
        }

        if ($form_result->hasError()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/annonces/ajoutBien');
        }

        Session::remove(Session::FORM_RESULT);
        self::redirect('/');
    }

    // Je cree la méthode por afficher les annonces créées par l'utilisateur qui est connecté.
    public function mesAnnonces()
    {
        $user = $_SESSION['USER'];
        $user_id = $user->id;

        $mesAnnonces = AppRepoManager::getRm()->getAnnoncesRepository()->getMesAnnonces($user_id);

        $data = [
            'title_tag' => 'Mes biens',
            'h1_tag' => 'Mes biens',
            'mesAnnonces' => $mesAnnonces,
        ];

        $view = new View('annonces/mesAnnonces');
        $view->render($data);
    }

    // Je ccree la méthode pour suprimer une annonce
    public function deleteAnnonce()
    {
    }
}

