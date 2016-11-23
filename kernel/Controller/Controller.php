<?php
namespace Kernel\Controller;

class Controller {

    // Chaque sous-controller appellera une vue dédiée à son action. Et cette vue a un chemin de répertoire
    protected $viewPath;

    // Chaque sous-controller pourra utiliser un template différent.
    protected $template;

    public function render($viewName,$datas =[]) {
        // permet de stocker dans la mémoire l'éxécution procédurale d'un fichier
        ob_start();
        // Récupérer les données du tableau associatif $datas sous forme de variable. Chaque clé du tableau assoc devient une variable autonome
        extract($datas);
        require($this->viewPath.$viewName.'.php');
        // on stock le résultat de ob_start dans la variable $content qui est utilisé dans le fichier template parent
        $content = ob_get_clean();

        require(ROOT.'/app/Views/templates/'.$this->template.'.php');
    }

}