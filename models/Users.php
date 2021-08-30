<?php

class Users
{

    private $id = 0;
    private $pseudo = '';
    private $mail = '';
    private $password_hash = '';
    private $pdo = null;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    }
    /**
     * Methode permettant d'enregistrer un utilisateur
     *
     * @return boolean
     */
    public function addUser()
    {
        $pdoStatment = $this->pdo->prepare('INSERT INTO users(pseudo, mail, password_hash) VALUES(:pseudo, :mail, :password_hash)');
        $pdoStatment->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $pdoStatment->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $pdoStatment->bindValue(':password_hash', $this->password_hash, PDO::PARAM_STR);
        return $pdoStatment->execute();
    }
/**
 * Fonction permettant de vérifier si un champ est unique
 *
 * @param [type] $field
 * @param [type] $value
 * @return boolean
 */
    public function isUnique($field, $value){
        $pdoStatment = $this->pdo->prepare('SELECT COUNT(*) AS `isUsed` FROM users WHERE '.$field.' = :'.$field);
        $pdoStatment->bindValue(':'.$field, $value, PDO::PARAM_STR);
        $pdoStatment->execute();
        return !$pdoStatment->fetch(PDO::FETCH_OBJ)->isUsed;
    }
    /**
     * Getter permettant d'avoir accès à tous les attributs de la classe
     * 
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            if ($property != 'pdo') {
                return $this->$property;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Setter permettant de modifier les attributs de la classe
     * 
     * @param string $property
     * @param mixed $value
     * @return boolean
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            if ($property != 'pdo') {
                $this->$property = $value;
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
