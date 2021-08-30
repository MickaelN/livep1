<?php
if(isset($_GET['action'])){
    if($_GET['action'] == 'disconnect'){
        unset($_SESSION['user']);
        header('Location: index.php');
        exit;
    }
}