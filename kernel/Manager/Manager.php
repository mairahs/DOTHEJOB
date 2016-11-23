<?php

namespace Kernel\Manager;

use Kernel\Manager\DB;

class Manager {

    protected $table;
    protected $db;

    // Injection de dépendance
    // Quand une classe communique avec une autre class qui doit être instanciée, on lui passe via un constructeur une instance de celle ci et on la type > ici son type est DB
    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";
        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }

    public function findOneBy($param,$value) {
    $sql = "SELECT * FROM {$this->table} WHERE $param = :$param";
        $this->db->query($sql);
        $this->db->bind(":$param",$value);
        $result = $this->db->single();
        return $result;
    }

    public function delete($key,$val,$table) {
        $sql = "DELETE FROM $table WHERE $key = :$key";
        $this->db->query($sql);
        $this->db->bind(":$key",$val);
        $this->db->execute();
    }

    public function save() {
  // 1> Récupération des attributs de l'entité à persister
        $attributes = $this->getAttributes();

        // 2-> On clean les attributs non mappés avec ma table de base de données
        unset($attributes['table']);
        unset($attributes['db']);
        var_dump($attributes);
        // 5-> Est-on en mode Update ?
       $mode_update = isset($attributes['id']) && is_numeric($attributes['id']) ? true : false;

        if($mode_update == false ) {
        unset($attributes['id']);
        //print_r($attributes);
        // 3-> Objectif de requête SQL à composer
        // INSERT INTO nom_table(nom_col,nom_col2) VALUES (:nom_col,:nom_col2)
        // INSERT INTO nom_table(nom,offre_short) VALUES (:nom,:offre_short)
        $keys = array_keys($attributes);
        $cols_req = implode(',',$keys);
        //echo $cols_req;

        // 4 -> Ajouter le préfixe ":" à chaque clé
        $cols_req_to_bind = "";
        foreach ($keys as $k) {
            // :id, :nom, :offre_short,
            $cols_req_to_bind .= ":".$k.", ";
        }
        $cols_req_to_bind = rtrim($cols_req_to_bind,", ");
        $sql = "INSERT INTO {$this->table} ";
        $sql .= "($cols_req) ";
        $sql .= "VALUES ($cols_req_to_bind)";
        //echo $sql;
        //die();

        } // Fin is mode update
        else {
            // On est en mode update
            // Requête à obtenir
           // $sql ="UPDATE $this->table
           //        SET nom = :nom, offre_short=:offre_short WHERE id=$id";
            $keys = array_keys($attributes);
            $cols_req_to_bind ="";
            foreach($keys as $k) {
                $cols_req_to_bind .= "$k = :$k,";
            }
            $cols_req_to_bind = rtrim($cols_req_to_bind,",");
            $sql = "UPDATE {$this->table} ";
            $sql .="SET $cols_req_to_bind ";
            $sql .="WHERE id = :id";

        }


        $this->db->query($sql);
        foreach($attributes as $k => $v) {
            if($k == "created_at") {
                $v = date("Y-m-d H:i:s");
            }
            $this->db->bind(":$k",$v);
        }
        $this->db->execute();
    }

    public function lastId() {
        return $this->db->getLastInsertId();
    }

}