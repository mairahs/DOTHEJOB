<?php
namespace Kernel\Manager;
// Import des class de la lib PHP > PDO
use \PDO;
use \PDOException;

class DB {

    private $db_name;
    private $db_user;
    private $db_password;
    private $db_host;
    // Connexion active
    private $dbh;
    // Mémoire de la requête
    private $stmt;

    //Constructeur qui lance la connexion à la DB
    function __construct($db_name, $db_user, $db_password, $db_host)
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_host = $db_host;

    $this->dbh = new PDO("mysql:dbname={$this->db_name};host={$this->db_host}",$this->db_user,$this->db_password);

        $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    // Préparer la requête > mettre en memoire du SGBD notre requête SQL
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }
    // Récupérer des collections d'objets > plusieurs résultats
    public function resultSet() {
        // Les résultats de la requête seront sous forme d'objet
        $this->stmt->setFetchMode(PDO::FETCH_OBJ);
        $this->execute();
        // Retourne un tableau d'objet > une collection
        return $this->stmt->fetchAll();
    }

    public function single() {
        $this->stmt->setFetchMode(PDO::FETCH_OBJ);
        $this->execute();
        // Retourne un objet > un seul résultat
        return $this->stmt->fetch();
    }

    public function bind($param,$value) {
    // switch de value pour déterminer quel type de data on attend
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        return $this->stmt->bindParam($param,$value,$type);
    }

    public function getLastInsertId() {
        return $this->dbh->lastInsertId();
    }

    public function execute() {
        return $this->stmt->execute();
    }

}