<?php
define('ROOT',dirname(__DIR__));
//echo ROOT;
require_once ROOT.'/app/App.php';
// Ici appel de l'autoloader
\App\App::ComposerAutoloader();
$app = \App\App::getInstance();

// Appel du système de routing
$app::manageRouting();