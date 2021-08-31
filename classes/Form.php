<?php

/**
 * Objet permettant de gerer les formulaires
 */
class Form
{

    public $error = array();
    const ALPHA_NUMERIC = '/^[a-zA-Z0-9]+$/';

    public function __construct()
    {
    }

    /**
     * Vérification que le champ n'est pas vide et qu'il existe
     * @param string $fieldName
     * @param string $fieldValue
     * @return boolean
     */
    public function isNotEmpty($fieldName, $fieldValue)
    {
        if (!empty($fieldValue)) {
            return true;
        } else {
            $this->error[$fieldName] = 'Le champ ' . $fieldName . ' est vide';
        }
    }

    public function isValidFormat($fieldName, $fieldValue, $format = SELF::ALPHA_NUMERIC)
    {
        if (preg_match($format, $fieldValue)) {
            return true;
        } else {
            $this->error[$fieldName] = 'Le champ ' . $fieldName . ' n\'est pas au bon format';
        }
    }

    /**
     * Vérification de l'unicité d'un champ
     * @param string $fieldName
     * @param string $fieldValue
     * @param string $className
     * @return mixed
     */
    public function isUnique($fieldName, $fieldValue, $className)
    {
        $class = new $className();
        if (method_exists($class, 'isUnique')) {
            if ($class->isUnique($fieldName, $fieldValue)) {
                return true;
            } else {
                $this->error[$fieldName] = 'Le champ ' . $fieldName . ' est déjà utilisé';
                return false;
            }
        } else {
            return null;
        }
    }
    /**
     * Vérification de l'existence d'une valeur
     *
     * @param [type] $fieldName
     * @param [type] $fieldValue
     * @param [type] $className
     * @return void
     */
    public function doesExist($fieldName, $fieldValue, $className)
    {
        $class = new $className();
        if (method_exists($class, 'doesExist')) {
            if ($class->doesExist($fieldName, $fieldValue)) {
                return true;
            } else {
                $this->error[$fieldName] = 'La valeur ' . $fieldName . ' n\'existe pas';
                return false;
            }
        } else {
            return null;
        }
    }

    /**
     * Vérification de la taille d'un champ
     * @param string $fieldName
     * @param string $fieldValue
     * @param int $min
     * @param int $max
     * @return boolean
     */
    public function isValidLength($fieldName, $fieldValue, $min, $max)
    {
        $length = strlen($fieldValue);
        if ($length >= $min && $length <= $max) {
            return true;
        } else {
            $this->error[$fieldName] = 'La taille du champ ' . $fieldName . ' doit être comprise entre ' . $min . ' et ' . $max;
            return false;
        }
    }
    /**
     * Vérification de la validité d'un email
     *
     * @param string $fieldName
     * @param string $fieldValue
     * @return boolean
     */
    public function isValidEmail($fieldName, $fieldValue)
    {
        if (filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->error[$fieldName] = 'Le champ ' . $fieldName . ' n\'est pas une adresse mail valide';
            return false;
        }
    }
    /**
     * Verification de la validité du formulaire
     *
     * @return boolean
     */
    public function isValid()
    {
        return empty($this->error);
    }
}
