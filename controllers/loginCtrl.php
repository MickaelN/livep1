<?php
require_once 'models/MainModel.php';
require_once 'models/Users.php';
require_once 'classes/Form.php';
if(isset($_POST['login'])){
    $mail = '';
    $plainPassword = '';
    $loginForm = new Form();
    if(isset($_POST['mail'])){
        $mail = htmlspecialchars($_POST['mail']);
    }
    if(isset($_POST['password'])){
        $plainPassword = $_POST['password'];
    }
    $loginForm->isNotEmpty('mail', $mail);
    $loginForm->isValidEmail('mail', $mail);

    $loginForm->isNotEmpty('password', $plainPassword);
    
    //Si le formulaire est correctement rempli
    if($loginForm->isValid()){
        $user = new Users();
        $user->__set('mail', $mail);
        $passwordHash = $user->getUserHash();
        if(password_verify($plainPassword, $passwordHash)){
            $_SESSION['user']['isConnected'] = true;
            $userInfo = $user->getUserInfoByMail();
            $_SESSION['user']['pseudo'] = $userInfo->pseudo;
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['user']['avatar'] = $userInfo->avatar;
            $_SESSION['user']['last_session_at'] = $userInfo->last_session_at;
            $_SESSION['user']['levelAccess'] = $userInfo->level;
            $_SESSION['user']['id'] = $userInfo->id;
            header('Location: index.php');
            exit;
        }
    }
}