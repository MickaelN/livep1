<?php
//inlusion du controlleur
require_once 'controllers/indexCtrl.php';
//inclusion du header
include 'views/header.php';
//Vérification que le fichier controller existe
if (file_exists('controllers/' . $module . $view . 'Ctrl.php')) {
    require 'controllers/' . $module . $view . 'Ctrl.php';
}
include 'views/' . $module . $view . '.php';
//inclusion du footer
include 'views/footer.php';
