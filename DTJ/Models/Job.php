<?php
namespace DTJ\Models;
use \Kernel\Manager\Manager;
use \App\App;
class Job extends Manager {


    protected $id;
    private $nom;
    private $offre_short;
    private $offre_long;
    private $created_at;
    private $id_cat;
    private $id_societe;
    private $id_contrat;

    // Attention ce champ n'est pas mappé avec la table job
    protected $table = "job";

//    public function __construct() {
//        $db = App::getInstance()->getDb();
//        parent:: __construct($db);
//        $this->created_at = date('Y-m-d H:i:s');
//
//    }
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getOffreShort()
    {
        return $this->offre_short;
    }

    /**
     * @param mixed $offre_short
     */
    public function setOffreShort($offre_short)
    {
        $this->offre_short = $offre_short;
    }

    /**
     * @return mixed
     */
    public function getOffreLong()
    {
        return $this->offre_long;
    }

    /**
     * @param mixed $offre_long
     */
    public function setOffreLong($offre_long)
    {
        $this->offre_long = $offre_long;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->id_cat;
    }

    /**
     * @param mixed $id_cat
     */
    public function setIdCat($id_cat)
    {
        $this->id_cat = $id_cat;
    }

    /**
     * @return mixed
     */
    public function getIdSociete()
    {
        return $this->id_societe;
    }

    /**
     * @param mixed $id_societe
     */
    public function setIdSociete($id_societe)
    {
        $this->id_societe = $id_societe;
    }

    /**
     * @return mixed
     */
    public function getIdContrat()
    {
        return $this->id_contrat;
    }

    /**
     * @param mixed $id_contrat
     */
    public function setIdContrat($id_contrat)
    {
        $this->id_contrat = $id_contrat;
    }


}