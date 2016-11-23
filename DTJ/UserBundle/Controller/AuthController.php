<?php
namespace DTJ\UserBundle\Controller;
use \Kernel\Controller\Controller;
use \Kernel\Form\FormFactory AS FF;
use \Kernel\Auth\DBAuth;
use \App\App;

class AuthController extends Controller {

    public function __construct(){
        $this->viewPath = dirname(__DIR__).'/Views/';
        $this->template = "main";
    }

    public function login() {
       $flash ="";
        if($_SERVER['REQUEST_METHOD'] =="POST") {
            $user = new DBAuth(App::getInstance()->getDb());
            if($user->login($_POST['username'],$_POST['password'])) {
                //die('connecté');
                header('Location: ?routing=admin/admin/index');
            } else {
                 $user->setFlash("t'es qui ??");
            }
            $flash = $user->getFlash();
        }

        // Affichera le formulaire pour s'identifier
        $form = new FF();
        $datas = compact('form','flash');
       return $this->render('login',$datas);
    }
}