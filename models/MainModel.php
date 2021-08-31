<?php

/**
 * Modèle principal de l'application
 */

class MainModel
{
    protected $pdo = null;
    protected $table = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            //A faire : Envoi d'un mail au technicien de l'application
        }
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
        } else {
            return false;
        }
    }
    /**
     * Fonction permettant de vérifier si un champ est unique
     *
     * @param [type] $field
     * @param [type] $value
     * @return boolean
     */
    public function isUnique($field, $value)
    {
        $pdoStatment = $this->pdo->prepare('SELECT COUNT(*) AS `isUsed` FROM ' . $this->table . ' WHERE ' . $field . ' = :' . $field);
        $pdoStatment->bindValue(':' . $field, $value, PDO::PARAM_STR);
        $pdoStatment->execute();
        return !$pdoStatment->fetch(PDO::FETCH_OBJ)->isUsed;
    }
    /**
     * Fonction permettant de vérifier si une value existe dans une table
     *
     * @param [type] $field
     * @param [type] $value
     * @return void
     */
    public function doesExist($field, $value)
    {
        $pdoStatment = $this->pdo->prepare('SELECT COUNT(*) AS `isUsed` FROM ' . $this->table . ' WHERE ' . $field . ' = :' . $field);
        $pdoStatment->bindValue(':' . $field, $value, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ)->isUsed;
    }

    public function getListChoices($key, $value){
        $pdoStatment = $this->pdo->query('SELECT `'.$key.'` AS `key`, `'.$value.'` AS `value` FROM `'.$this->table.'`');
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }
}
