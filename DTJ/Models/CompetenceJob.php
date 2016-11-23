<?php
namespace DTJ\Models;

use Kernel\Manager\Manager;

class CompetenceJob extends Manager{
    protected $table ="competence_job";
    private $id;
    private $id_j;
    private $id_c;

    /**
     * Retourne tous les attributs de la classe sous forme de tableau
     * @return array
     */
    protected function getAttributes() {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdJ()
    {
        return $this->id_j;
    }

    /**
     * @param mixed $id_j
     */
    public function setIdJ($id_j)
    {
        $this->id_j = $id_j;
    }

    /**
     * @return mixed
     */
    public function getIdC()
    {
        return $this->id_c;
    }

    /**
     * @param mixed $id_c
     */
    public function setIdC($id_c)
    {
        $this->id_c = $id_c;
    }



}