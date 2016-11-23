<?php
namespace DTJ\JobBundle\Controller;
use \Kernel\Controller\Controller;
use \App\App;

class MainController extends Controller {

    public function __construct(){
        $this->viewPath = dirname(__DIR__).'/Views/';
        $this->template = "main";
    }

    public function index() {
   $jobs = App::getInstance()->makeRepository('job')->getAllJobs();
// On unifie un job et ses compétences en un seul objet. Chaque objet job est stocké dans un tableau dédié > $tab_objet_jobs_competences
   $tab_objet_jobs_competences = [];
        foreach($jobs as $key=>$job) {
   $job_competences = App::getInstance()->makeRepository('competence')->getCompetencesByJob($job->id);
   $tab_objet_jobs_competences[$key] = array("job"=>$job,'competences'=>$job_competences);
            //var_dump($job_competences);
        }

//var_dump($tab_objet_jobs_competences);

       // die();


  $categories = App::getInstance()->makeRepository('category')->findAll();
  $datas = compact('tab_objet_jobs_competences','categories');

 // Return de la vue correspondante avec les données
        return $this->render('index',$datas);
    }



    public function show() {
        $id = $_GET['id'];
$job = App::getInstance()->makeRepository('job')->findOneBy('id',$id);
$categories = App::getInstance()->makeRepository('category')->findAll();
        $datas = compact('job','categories');
        return $this->render('show',$datas);
    }

    // Voir les offres triées par compétence
    public function competence() {
$id_competence = $_GET['id_competence'];
$jobs = App::getInstance()->makeRepository('job')->getAllJobsByCompetence($id_competence);
// On unifie un job et ses compétences en un seul objet. Chaque objet job est stocké dans un tableau dédié > $tab_objet_jobs_competences
        $tab_objet_jobs_competences = [];
        foreach($jobs as $key=>$job) {
            $job_competences = App::getInstance()->makeRepository('competence')->getCompetencesByJob($job->id);
            $tab_objet_jobs_competences[$key] = array("job"=>$job,'competences'=>$job_competences);
            //var_dump($job_competences);
        }
$categories = App::getInstance()->makeRepository('category')->findAll();
$datas = compact('categories','tab_objet_jobs_competences');
        return $this->render('index',$datas);
    }

    // Voir les offres triées par compétence
    public function category() {
        $id_category = $_GET['id_category'];
        $jobs = App::getInstance()->makeRepository('job')->getAllJobsByCat($id_category);

        $tab_objet_jobs_competences = [];
        foreach($jobs as $key=>$job) {
            $job_competences = App::getInstance()->makeRepository('competence')->getCompetencesByJob($job->id);
            $tab_objet_jobs_competences[$key] = array("job"=>$job,'competences'=>$job_competences);
            //var_dump($job_competences);
        }
        $categories = App::getInstance()->makeRepository('category')->findAll();
        $datas = compact('categories','tab_objet_jobs_competences');
        return $this->render('index',$datas);
    }



}