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

    public function addAnnonces(ServerRequest $request)
    {

        $post_data = $request->getParsedBody();
        $user = $_SESSION['USER'];

        $user = $user->id;


        $image_data = $_FILES['images'];
        $form_result = new FormResult();


        // Condition pour restreindre les types de fichiers image que vous souhaitez recevoir
        if (
            $image_data['type'] !== 'image/jpeg' &&
            $image_data['type'] !== 'image/png' &&
            $image_data['type'] !== 'image/jpg' &&
            $image_data['type'] !== 'image/webp'
        ) {
            $form_result->addError(new FormError('Le format de l\'image n\'est pas valide'));
        } else if (
            // Vérifiez si d'autres champs requis sont vides
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
            // Traitez les données
            // Nettoyez et validez les champs d'entrée
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

            // Gérez le téléchargement de l'image
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

        // En cas de réussite, supprimez le résultat du formulaire de la session et redirigez vers la page d'administration
        Session::remove(Session::FORM_RESULT);
        self::redirect('/');

        var_dump($data);
        die();
    }
}
