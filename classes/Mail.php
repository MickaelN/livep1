<?php
/**
 * Class d'envoi de mail
 */
class Mail{
    private $to;
    private $subject;
    private $message;
    private $headers;
    private $cc;
    private $bcc;
    private $from;
    private $title;
    private $content = [];

    public function __construct(){

    }

    private function buildMessage(){
        $this->message = 
        '<html><head><title>'.$this->title.'</title></head>'
        .'<body><h1>'.$this->title.'</h1>';
    }

}