<?php
namespace DTJ\AdminBundle\Controller;
use \Kernel\Controller\Controller;
use \App\App;
use \Kernel\Auth\DBAuth;
use \Kernel\Form\FormFactory as FF;
use \Kernel\Manager\Manager;


class AdminController extends Controller {

    public function __construct(){
        $this->viewPath = dirname(__DIR__).'/Views/';
        $this->template = "main";
        $user = new DBAuth(App::getInstance()->getDb());
        if($user->isLogged()== false) {
           // $user->setFlash("Tu n'as pas le droit");
            header('Location: ?routing=user/auth/login');
        }
    }

    public function index() {
        $jobs = App::getInstance()->makeRepository('job')->findAll();
        $datas = compact('jobs');
        return $this->render('index',$datas);
    }

    public function manageJob() {
       // 1-> Affichage du formulaire en mode ajout ou modif
        $mode_update = isset($_GET['id_job']) ? true: false ;
        // Mode modif
        if($mode_update) {
            $id_job = $_GET['id_job'];
            $job = App::getInstance()
                ->makeRepository('job')
                ->findOneBy('id',$id_job);
            // var_dump($job);
            // die();
            $form = new FF($job);
            $competences_actuelles = App::getInstance()->makeRepository('competence')->getCompetencesByJob($id_job);
            //var_dump($competences_actuelles);
            //die();
        }
        // Mode ajout
        else {
            $form = new FF();
            $competences_actuelles = array();
        }

        // 2-> Validation du formulaire > soit on fait un ajout > insert into , soit on fait une modif > update > ce test est délégué à la méthode save() du manager
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $job = App::getInstance()->makeEntity('job');
            if($mode_update) {
                $job->setId($id_job);
            }
            $job->setNom($_POST['nom']);
            $job->setOffreShort($_POST['offre_short']);
            $job->setOffreLong($_POST['offre_long']);
            $job->setIdCat($_POST['id_cat']);
            $job->setIdContrat($_POST['id_contrat']);
            $job->setIdSociete($_POST['id_societe']);
            $job->save();

           // print_r($_POST);
           // die();
            $manager = App::getInstance()->getManager();
            $last_job_id = $manager->lastId();

            // Suppresstion des compétences dans la table competence_job
            foreach($competences_actuelles as $ca) {
                $manager->delete("id_j",$ca->id_j,'competence_job');
            }


            // Création des compétences dans la table competence_job
            //echo $last_job_id;
            //die();
            foreach($_POST['competences'] as $id_competence) {

$job_competence = App::getInstance()->makeEntity('competenceJob');

                if($mode_update) {
                    $job_competence->setIdJ($id_job);
                } else {
                    $job_competence->setIdJ($last_job_id);
                }

                $job_competence->setIdC($id_competence);
                $job_competence->save();
            }
            header('Location: ?routing=admin/admin/index');
        } // Fin de l'ajout ou de la modif, càd on a cliqué sur valider


// Passage des datas nécessaires pour afficher les champs de type select et checkbox du formulaire
 $categories = App::getInstance()->makeRepository('category')->findAll();
 $societes = App::getInstance()->makeRepository('societe')->findAll();
 $contrats = App::getInstance()->makeRepository('contrat')->findAll();$competences = App::getInstance()->makeRepository('competence')->findAll();

//var_dump($categories);
        //die();
// Passage des variables à la vue
        $datas = compact('form','categories','societes','contrats','competences','competences_actuelles');

        return $this->render('manage',$datas);

    }

// Supprimer une offre
   public function deleteJob() {
 $id_job = isset($_GET['id_job']) ?$_GET['id_job'] : NULL;
       if(is_numeric($id_job)) {
           $manager = App::getInstance()->getManager();
           $manager->delete("id",$id_job,"job");
           header('Location: ?routing=admin/admin/index');
       }
   }



}