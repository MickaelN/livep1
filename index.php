<?php
//inlusion du controlleur
require_once 'controllers/indexCtrl.php';
//inclusion du header
include 'views/header.php';
//Vérification que le fichier controller existe
if (file_exists('controllers/' . $view . 'Ctrl.php')) {
    require 'controllers/' . $view . 'Ctrl.php';
}
include 'views/' . $view . '.php';
//inclusion du footer
include 'views/footer.php';
