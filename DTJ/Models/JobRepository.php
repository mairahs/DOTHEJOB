<?php
namespace DTJ\Models;
use \Kernel\Manager\Manager;

class JobRepository extends Manager {

    protected $table = "job";


    public function getAllJobs() {
 $sql = "SELECT j.id, j.nom AS jobNom, j.created_at, j.offre_short, s.nom as socNom ,c.nom AS contratNom ";
        $sql.= "FROM {$this->table} AS j,societe AS s, contrat AS c ";
        $sql.= "WHERE j.id_societe = s.id ";
        $sql.= "AND j.id_contrat = c.id";

        //echo $sql;
        //die();
        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }


    public function getAllJobsByCat($id_category) {
        $sql ="SELECT j.id, j.nom AS jobNom, j.created_at, j.offre_short, soc.nom as socNom ,co.nom AS contratNom ";
        $sql .="FROM {$this->table} AS j ";
        $sql .="LEFT JOIN categorie AS cat ON cat.id = j.id_cat ";
        $sql .="LEFT JOIN contrat AS co ON co.id = j.id_contrat ";
        $sql .="LEFT JOIN societe AS soc ON soc.id = j.id_societe ";
        $sql .="WHERE cat.id = :id_category";

        $this->db->query($sql);
        $this->db->bind('id_category',$id_category);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getAllJobsByCompetence($id_competence) {
    $sql = "SELECT j.id, j.nom AS jobNom, j.created_at, j.offre_short, s.nom as socNom ,c.nom AS contratNom ";
    $sql.= "FROM {$this->table} AS j,societe AS s, contrat AS c, competence_job as cj ";
    $sql.= "WHERE j.id_societe = s.id ";
    $sql.= "AND j.id_contrat = c.id ";
    $sql.= "AND cj.id_j = j.id ";
    $sql.= "AND cj.id_c = :id_competence";

    //echo $sql;
    //die();
    $this->db->query($sql);
    $this->db->bind("id_competence",$id_competence);
    $result = $this->db->resultSet();
    return $result;
}

// Même fonction que getAllJobsByCompetence mais en version LEFT JOIN
    public function getAllJobsByCompetenceLeft($id_competence) {
        $sql = "SELECT j.id, j.nom AS jobNom, j.created_at, j.offre_short, s.nom as socNom ,c.nom AS contratNom ";
        $sql .= "FROM job AS j ";
        $sql .= "LEFT JOIN societe AS s ON s.id = j.id_societe ";
        $sql .= "LEFT JOIN contrat AS c ON c.id = j.id_contrat ";
        $sql .= "LEFT JOIN competence_job AS cj ON cj.id_j = j.id ";
        $sql .= "WHERE cj.id_c = :id_competence";

        $this->db->query($sql);
        $this->db->bind("id_competence",$id_competence);
        $result = $this->db->resultSet();
        return $result;
    }



}