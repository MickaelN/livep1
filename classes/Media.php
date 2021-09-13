<?php

class Media
{

    public $errors = [];
    /**
     * attributs pour la vérifications du fichier
     *
     */
    public $allowedExtensions = [];
    public $allowedMediaType = [];
    //Poids du fichier
    public $maxSize = 0;
    //Hauteur et largeur max de l'image si cela en est une
    public $maxWidth = 0;
    public $maxHeight = 0;
    //Hauteur et largeur min de l'image si cela en est une
    public $minWidth = 0;
    public $minHeight = 0;
    private $extension = '';

    /**
     * Attributs pour la gestion du fichier
     */
    public $mediaDirectory = '';

    //Ici on stockera le $_Files['myFile']
    public $file;

    /**
     * Methode permettant de vérifier si le fichier à la bonne extension
     *
     * @return boolean
     */
    private function isValidExtension()
    {
        $this->extension = strtolower(pathinfo($this->file['name'], PATHINFO_EXTENSION));
        if (!in_array($this->extension, $this->allowedExtensions)) {
            $this->errors['extension'] = 'Extension du fichier non valide';
            return false;
        }
        return true;
    }

    /**
     * Methode permettant de vérifier si le fichier à la bonne taille/poids
     */
    private function isValidSize()
    {
        var_dump($this->file['size'] );
        if ($this->file['size'] > $this->maxSize) {
            $this->errors['size'] = 'Fichier trop volumineux';
            return false;
        }
        return true;
    }

    /**
     * Méthode permttant de vérifier si le fichier à le bon type
     * https://fr.wikipedia.org/wiki/Type_de_m%C3%A9dias
     * @return boolean
     */
    private function isValidMediaType()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = mime_content_type($this->file['tmp_name']);
        var_dump($mime);
        if (!in_array($mime, $this->allowedMediaType)) {
            $this->errors['mediaType'] = 'Type de média non valide';
            return false;
        }
        return true;
    }
    /**
     * Méthode permettant de vérifier si les dimensions de l'image sont valides
     */
    private function isValidDimension()
    {
        /* 
         * $imageSize sera un tableau contenant les dimensions de l'image.
         * l'index 0 contient la largeur
         *  l'index 1 contient la hauteur
        */
        $imageSize = getimagesize($this->file['tmp_name']);
        if ($imageSize[0] < $this->minWidth || $imageSize[0] > $this->maxWidth) {
            $this->errors['dimension'][] = 'Largeur non valide';
        }
        if ($imageSize[1] < $this->minHeight || $imageSize[1] > $this->maxHeight) {
            $this->errors['dimension'][] = 'Hauteur non valide';
        }
        //Si il y a des erreurs dans le tableau des erreurs on renvoit faux
        if (!empty($this->errors['dimension'])) {
            return false;
        }
        return true;
    }

    public function isValidImage()
    {
        if (!$this->isValidExtension() || !$this->isValidSize() /*|| !$this->isValidMediaType()*/) {
            return false;
        }
        if (!$this->isValidDimension()) {
            return false;
        }
        return true;
    }

    public function addfolder()
    {
        if (!file_exists($this->mediaDirectory)) {
            return mkdir($this->mediaDirectory, 0777, true);
        }
        return true;
    }

    public function uploadFiles()
    {
        return move_uploaded_file($this->file['tmp_name'], $this->mediaDirectory . $this->file['name']);
    }

    public function resizeImage()
    {
        $imageSize = getimagesize($this->file['tmp_name']);
        if ($this->extension == 'jpg' || $this->extension == 'jpeg') {
            $imageSource = imagecreatefromjpeg($this->file['tmp_name']);
        } else if ($this->extension == 'png') {
            $imageSource = imagecreatefrompng($this->file['tmp_name']);
        } else if ($this->extension == 'gif') {
            $imageSource = imagecreatefromgif($this->file['tmp_name']);
        }
        $imageDest = imagecreatetruecolor($this->minWidth, $this->minHeight);
        imagecopyresampled($imageDest, $imageSource, 0, 0, 0, 0, $this->minWidth, $this->minHeigt, $imageSize[0], $imageSize[1]);
    }
}
