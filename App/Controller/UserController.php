<?php

namespace App\Controller;

use App\Model\User;
use Core\Session\Session;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\View\View;
use Core\Controller\Controller;
use Core\Repository\AppRepoManager;

use App\Model\Repository\UserRepository;


use Laminas\Diactoros\ServerRequest;



class UserController extends Controller
{

    public const AUTH_SALT = 'c56a7523d96942a834b9cdc249bd4e8c7aa9';
    public const AUTH_PEPPER = '8d746680fd4d7cbac57fa9f033115fc52196';

    public function login()
    {
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];

        $view = new View('user/login');
        $view->render($view_data);
    }

    //je cree la methode qui va recevoir les donnes de formulaire de connexion
    public function loginPost(ServerRequest $request)
    {
        //je recupre les donnes de formulaire dans la variable 
        $post_data = $request->getParsedBody();

        //je cree une instance de FormResult
        $form_result = new FormResult();

        //Je cree une instance de User
        $user = new User;

        //verification d si les champs sont remplis:
        if (empty($post_data['email']) || empty($post_data['password'])) {
            $form_result->addError(new FormError('Veuillez remplir tous les champs'));
        } else {
            //sinon confronte les valeurs saisies avec les donnes en Bdd
            //je redefini les variables
            $email = $post_data['email'];
            $password = self::hash($post_data['password']);
            $user = AppRepoManager::getRm()->getUserRepository()->checkAuth($email, $password);

            //si le retour est negatif, j affiche message d erreur
            if (is_null($user)) {
                $form_result->addError(new FormError('Email ou mot de pass incorrect'));
            }
        }

        //si j ai des erreurs, j renvoie vers la page login pour pas envoyer l utilisateur dans une page blanche
        if ($form_result->hasError()) {
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/login');
        }

        //s il y a pas d erreurs et l utilisateur a tout bien fais, il est redirige vers la page d accueil
        // et juste avant j efface le mot de pass
        $user->password = '';
        Session::set(Session::USER, $user);

        self::redirect('/');
    }

    //methode pour encoder le mdp avec hash
    public static function hash(string $password): string
    {
        return hash('sha512', self::AUTH_SALT . $password . self::AUTH_PEPPER);
    }

    public static function isAuth(): bool
    {
        return !is_null(Session::get(Session::USER));
    }

    public function inscription()

    {
        //On récupère la liste des utilisateurs
        //on reconstruit le tableau de données
        $view_data = [
            'form_result' => Session::get(Session::FORM_RESULT)
        ];

        $view = new View('user/inscription');
        $view->render($view_data);
    }

    public static function isUser(): bool

    {

        return !is_null(Session::get(Session::USER));
    }

    public static function isHote(): bool

    {

        if (!self::isUser()) {

            return false;
        }



        $user = Session::get(Session::USER);

        return !is_null($user) && $user->is_hote == 1;
    }


    //méthode de déconnexion
    public function logout()
    {
        //on détruit la session
        Session::remove(Session::USER);
        self::redirect('/');
    }



    public function add(ServerRequest $request)
    {

        $post_data = $request->getParsedBody();
        $form_result = new FormResult();

        if (empty($post_data['email']) || empty($post_data['password']) || empty($post_data['is_hote']) || empty($post_data['nom']) || empty($post_data['prenom']) || empty($post_data['date_inscription'])) {
            $form_result->addError(new FormError('Tous les champs sont obligatoires'));
            Session::set(Session::FORM_RESULT, $form_result);
            self::redirect('/inscription');
        } else {
            // On récupère les données du formulaire
            $email = htmlspecialchars(trim(strtolower($post_data['email'])));
            $password = htmlspecialchars(trim($post_data['password']));
            $pass_hash = UserController::hash($password);
            $is_hote = intval($post_data['is_hote']);
            $nom = htmlspecialchars(trim($post_data['nom']));
            $prenom = htmlspecialchars(trim($post_data['prenom']));
            $date_inscription = htmlspecialchars(trim($post_data['date_inscription']));

            // On crée un nouvel utilisateur
            $user = AppRepoManager::getRm()->getUserRepo()->createUser($email, $pass_hash, $is_hote, $nom, $prenom, $date_inscription);

            // Si l'utilisateur n'est pas créé, on renvoie un message d'erreur
            if (!$user) {
                $form_result->addError(new FormError('L\'utilisateur existe déjà'));
                Session::set(Session::FORM_RESULT, $form_result);
                self::redirect('/inscription');
            } else {
                // Sinon, on redirige vers la page admin
                Session::remove(Session::FORM_RESULT);
                self::redirect('/');
            }
        }
    }
}
