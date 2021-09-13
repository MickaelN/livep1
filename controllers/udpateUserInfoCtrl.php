<?php

require '../config.php';
require '../models/MainModel.php';
require '../models/Users.php';
require '../classes/Form.php';
require '../classes/Media.php';


$form = new Form();
$updateArray = [];

if (isset($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
    $form->isNotEmpty('pseudo', $pseudo);
    $form->isValidFormat('pseudo', FORM::ALPHA_NUMERIC);
    $form->isValidLength('pseudo', $pseudo, 3, 50);
    $form->isUnique('pseudo', $pseudo, 'users');
    if (!isset($form->errors['pseudo'])) {
        $updateArray['pseudo'] = $pseudo;
    }
}
if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    $form->isNotEmpty('mail', $mail);
    $form->isValidEmail('mail', $mail);
    $form->isUnique('mail', $mail, 'users');
    if (!isset($form->errors['mail'])) {
        $updateArray['mail'] = $mail;
    }
}
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
    $media = new Media();
    $media->file = $_FILES['avatar'];
    $media->allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $media->maxSize = 10000000;
    $media->allowedMediaType=[ 'image/jpeg', 'image/png', 'image/gif'];
    $media->minWidth = 256;
    $media->minHeight = 256;
    $media->maxWidth = 1920;
    $media->maxHeight = 1080;
    if(! $media->isValidImage()){
        var_dump($_FILES['avatar']);
        echo json_encode($media->errors);
    }
   // $avatar = $_POST['avatar'];
}






if (!empty($updateArray)) {
    $user = new Users();
    $user->__set('id', $_SESSION['user']['id']);
    $isUpdating =  $user->updateUserInfos($updateArray);

    echo json_encode(['message' => $isUpdating]);
} else {
    echo json_encode($form->error);
}
