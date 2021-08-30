<?php
require_once 'models/Users.php';
require_once 'classes/Form.php';
$registerForm = new Form();

//Si j'ai bien validé le formulaire
if (isset($_POST['register'])) {
    $pseudo = '';
    $mail = '';
    $plainPassword = '';
    //Je récupère les données du formulaire
    if (isset($_POST['pseudo'])) {
        $pseudo = $_POST['pseudo'];
    }
    if (isset($_POST['mail'])) {
        $mail = $_POST['mail'];
    }
    if (isset($_POST['password'])) {
        $plainPassword = $_POST['password'];
    }

    //Je vérifie le pseudo
    $registerForm->isNotEmpty('pseudo', $pseudo);
    $registerForm->isValidFormat('pseudo', $pseudo, FORM::ALPHA_NUMERIC);
    $registerForm->isUnique('pseudo', $pseudo, 'users');
    $registerForm->isValidLength('pseudo', $pseudo, 3, 50);
    //Je vérifie le mail
    $registerForm->isNotEmpty('mail', $mail);
    $registerForm->isValidEmail('mail', $mail);
    $registerForm->isUnique('mail', $mail, 'users');
    //Je vérifie le mot de passe
    $registerForm->isNotEmpty('password', $plainPassword);
    $registerForm->isValidLength('password', $plainPassword, 6, 255);

    //Si il n'y a pas d'erreur sur le formulaire
    if ($registerForm->isValid()) {
        $user = new Users();
        $user->__set('pseudo', $pseudo);
        //Je hash le mot de passe
        $hashPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
        $user->__set('password', $hashPassword);
        $user->__set('mail', $mail);
        $user->addUser();
    }
}
