<?php

class MailType extends MainModel{
    protected $id;
    protected $name;
    protected $table = 'mailtype';

    public function __construct(){
        parent::__construct();
    }


}