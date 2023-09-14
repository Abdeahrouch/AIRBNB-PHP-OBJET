<?php

namespace Core;


use MiladRahimi\PhpRouter\Router;
use App\Controller\UserController;
use App\Controller\AnnoncesController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;

class App implements DatabaseConfigInterface
{
    //on va déclarer des constantes
    private const DB_HOST = 'database';
    private const DB_NAME = 'tp-php-airbnb';
    private const DB_USER = 'admin';
    private const DB_PASS = 'admin';
    // on va crée une propriété qui va contenir l'instance sz notre classe

    private static ?self $instance = null;
    //proprité qui va contenir l'instance de routeur (MiladRahimi)
    private Router $router;
    // Création d'une méthode qui sera appelé au démarrage de l'appli dans index.php

    public static function getApp(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    //Méthode qui instancie Router
    public function getRouter(): Router
    {
        return $this->router;
    }

    private function __construct()
    {
        // Router::creater = méthode statique de la classe router crée par le cousin  qui permet de créer une instance de routeur
        $this->router = Router::create();
    }

    //Une fois le router instancié, on aura 3 méthode a définir 
    //1: méthode start (activation du router)
    public function start(): void
    {
        //on démarre la session
        session_start();
        //on enregistre kes riytes
        $this->registerRoutes();
        //on démarre le router
        $this->startRouter();
    }

    //2: Méthode resisterRoutes (enregistrement des routes)
    private function registerRoutes(): void
    {

        //Déclaration des patterns pour tester les valeurs des arguments 
        $this->router->pattern('id', '[0-9]\d*');
        $this->router->pattern('slug', '(\d+-)?[a-z]+(-[a-z\d]+)*');
        //On crée la route pour la page d'accueil avec la controlleur
        $this->router->get('/', [AnnoncesController::class, 'index']);
        //route pour acceder a inscription
        $this->router->get('/inscription', [UserController::class, 'inscription']);
        //route pour acceder a login
        $this->router->get('/login', [UserController::class, 'login']);
        //route pour envoyer les info a login
        $this->router->post('/login', [UserController::class, 'loginPost']);

        $this->router->get('/logout', [UserController::class, 'logout']);

        $this->router->post('/inscription', [UserController::class, 'add']);

        $this->router->get('/detail/{id}', [AnnoncesController::class, 'detailAnnonce']);

        $this->router->get('/bien', [AnnoncesController::class, 'addBien']);
    }

    //3: Méthode startRouter (lancement du router)
    private function startRouter(): void
    {
        try {
            $this->router->dispatch();
        } catch (RouteNotFoundException $e) {
            echo $e->getMessage();
        } catch (InvalidCallableException $e) {
            echo $e->getMessage();
        }
    }




    //on doit OBLIGATOIREMENT déclarée les methodes issues de l'interface parente
    public function getHost(): string
    {
        return self::DB_HOST;
    }
    public function getName(): string
    {
        return self::DB_NAME;
    }
    public function getUser(): string
    {
        return self::DB_USER;
    }
    public function getPass(): string
    {
        return self::DB_PASS;
    }
}
