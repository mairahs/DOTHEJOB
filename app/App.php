<?php
namespace App;

use Kernel\Config\Config;
use Kernel\Manager\DB;
use Kernel\Manager\Manager;

class App {
    // 1-> Gestion de l'instanciation de la class
    // Je veux pouvoir m'en servir dans tout le projet
    // On utilise le design Pattern Singleton
    private static $_instance;
    private $db_instance;


    // Singleton => garantie de l'unicité de l'instance
    public static function getInstance() {
   // Si jamais instancié on le fait, sinon on récupère l'instance déjà faite.
        if(is_null(self::$_instance)) {
            self::$_instance = new App();

        }
        return self::$_instance;
    }

    // Appel de l'autoloader de composer
    public static function ComposerAutoloader() {
        require '../vendor/autoload.php';
    }



    // Gestion du routing
    public static function manageRouting() {
    $config =  Config::getInstance(ROOT.'/kernel/Config/parameters.php');
    $app_name = $config->get('app_name');
        $routing = isset($_GET['routing']) ? $_GET['routing']:'';
        $routing = explode("/",$routing);
        //var_dump($routing);
        // [0] => nom du bundle
        // [1] => nom du Controller
        // [2] => nom de l'action
        // Objectif : instanciation dynamique de la class Controller correspondante à la route
        $controller = "$app_name\\";
        $controller .=ucfirst($routing[0])."Bundle\\Controller\\";
        $controller .=ucfirst($routing[1])."Controller";
        //echo $controller;
        //die();
        $action = $routing[2];

        $controller = new $controller();
        $callAction = $controller->$action();

        return $callAction;
    }

    // Design Pattern Factory
    public function makeRepository($repo) {
        $config =  Config::getInstance(ROOT.'/kernel/Config/parameters.php');
        $app_name = $config->get('app_name');
        $repo =ucfirst($repo)."Repository";
        $repo_name = "$app_name\\Models\\$repo";
        // return new DTJ\Models\JobRepository($db);
        return new $repo_name($this->getDb());
    }

    public function makeEntity($entity) {
        $config =  Config::getInstance(ROOT.'/kernel/Config/parameters.php');
        $app_name = $config->get('app_name');
        $entity = ucfirst($entity);
        $entity_name = "$app_name\\Models\\$entity";
        return new $entity_name($this->getDb());
    }

    public function getManager() {
        $manager = new Manager($this->getDb());
        return $manager;
    }

    public function getDb() {
    $config =  Config::getInstance(ROOT.'/kernel/Config/parameters.php');
        if(is_null($this->db_instance)) {
               // ici appel de la class DB gérée par PDO
            return $this->db_instance = new DB($config->get('db_name'),
                          $config->get('db_user'),
                          $config->get('db_password'),
                          $config->get('db_host'));
        }
        return $this->db_instance;
    }





}