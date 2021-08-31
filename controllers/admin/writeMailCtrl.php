<?php
//Permet de n'autoriser l'accès à la page que si l'utilisateur est connecté et à les bons niveaux de droits
authorizedAccess(100);

require_once 'models/MainModel.php';
require_once 'models/MailType.php';
require_once 'models/Mail.php';
require_once 'classes/Form.php';
$types = new MailType();
$typesList = $types->getListChoices('id','name');

if (isset($_POST['saveMail'])) {
    $subject = '';
    $content = '';
    $mailType = 0;
    var_dump($_POST);
    if(isset($_POST['subject'])) {
        $subject = htmlspecialchars($_POST['subject']);
    }
    if(isset($_POST['content'])) {
        $content = $_POST['content'];
    }
    if(isset($_POST['mailType'])) {
        $mailType = $_POST['mailType'];
    }

    $mailForm = new Form();
    $mailForm->isNotEmpty('subject', $subject);
    $mailForm->isValidLength('subject', $subject, 3,255);

    $mailForm->isNotEmpty('content', $content);

    $mailForm->isNotEmpty('mailType', $mailType);
    $mailForm->doesExist('id', $mailType, 'MailType');
var_dump($mailForm->error);
    if ($mailForm->isValid()) {
        $mail = new Mail();
        $mail->__set('subject', $subject);
        $mail->__set('content', $content);
        $mail->__set('id_mailtype', $mailType);
        $mail->addMail();
    }
}
