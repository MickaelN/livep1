<?php
$script = '';
//Je vérifie la page demandée
if (!empty($_GET['view'])) {
    //Dans le cas où la page demandée est la page d'inscription
    if ($_GET['view'] == 'register') {
        $view = 'register';
    } else if ($_GET['view'] == 'login') {
        $view = 'login';
    }else if ($_GET['view'] == 'writeMail') {
        $view = 'writeMail';
        $script .= '<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector: \'#content\',plugins: \'advlist link image lists\'});</script>';
    }
} else { //Dans le cas où il n'y a pas de page demandée
    $view = 'home';
}

if (!empty($_GET['module'])) {
    if ($_GET['module'] == 'admin') {
        $module = 'admin/';
    }
} else {
    $module = '';
}

function authorizedAccess($levelMin){
    if(!isset($_SESSION['user']['isConnected']) || !$_SESSION['user']['isConnected'] || $_SESSION['user']['levelAccess'] < $levelMin){
        header('Location: index.php');
        exit;
    }
}