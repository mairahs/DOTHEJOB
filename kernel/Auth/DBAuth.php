<?php
namespace Kernel\Auth;
use \Kernel\Manager\DB;
use \Kernel\Auth\Flash;


class DBAuth extends Flash{

    private $db;
    protected $session;

    // Concept de l'injection de dépendance
    // On a absolument besoin d'une instance de DB
    public function __construct(DB $db) {
        $this->db = $db;
        // Dès l'instanciation de cette Class on démarre une session pour l'utilisateur
        $this->session = session_start();
    }

    // Connecter un utilisateur
    public function login($username,$password) {
        $sql ="SELECT * FROM user WHERE username= :username AND password = :password";
        $this->db->query($sql);
        $this->db->bind('username',$username);
        $this->db->bind('password',sha1($password));
        $user = $this->db->single();
        if($user == true) {
            $_SESSION['is_logged'] = true;
            $_SESSION['id_user'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

    // Vérifier si un user est connecté
    public function isLogged() {
        return isset($_SESSION['is_logged']);
    }

    // Récupérer l'id d'un user
    public function getIdUser() {
        return $_SESSION['id_user'];
    }

}