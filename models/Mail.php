<?php
class Mail extends MainModel
{
    protected $id;
    protected $subject;
    protected $content;
    protected $id_mailtype;
    protected $table = 'mail';

    public function __construct()
    {
        parent::__construct();
    }

    public function addMail(){
        $pdoStatment = $this->pdo->prepare('INSERT INTO mail(subject, content, id_mailtype) VALUES(:subject, :content, :id_mailtype)');
        $pdoStatment->bindValue(':subject', $this->subject, PDO::PARAM_STR);
        $pdoStatment->bindValue(':content', $this->content, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id_mailtype', $this->id_mailtype, PDO::PARAM_INT);
        $pdoStatment->execute();
    }
}
