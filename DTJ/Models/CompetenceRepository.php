<?php

namespace DTJ\Models;
use \Kernel\Manager\Manager;

class CompetenceRepository extends Manager  {

    protected $table ="competence";

    public function getCompetencesByJob($id_job) {
        $sql  ="SELECT * ";
        $sql .="FROM competence_job AS cj, {$this->table} AS c ";
        $sql .="WHERE cj.id_j = :id_job ";
        $sql .="AND cj.id_c = c.id";

        $this->db->query($sql);
        $this->db->bind('id_job',$id_job);
        $result = $this->db->resultSet();
        return $result;

    }


}