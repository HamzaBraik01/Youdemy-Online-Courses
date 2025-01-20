<?php
require_once 'Database.php';
require_once 'Cours.php';
class Context extends Course {
    private $objectif;

    public function __construct($id, $title, $description, $content, $image, $status, $objectif) {
        parent::__construct($id, $title, $description, $content, $image, 'CONTEXTE', $status);
        $this->objectif = $objectif;
    }

    public function getObjectif() {
        return $this->objectif;
    }
}
?>