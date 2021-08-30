<?php
//Je vérifie la page demandée
if(!empty($_GET['view'])){
    //Dans le cas où la page demandée est la page d'inscription
    if($_GET['view'] == 'register'){
        $view = 'register';
    }else if($_GET['view'] == 'login'){
        $view = 'login';
    }
}else{ //Dans le cas où il n'y a pas de page demandée
    $view = 'home';
}