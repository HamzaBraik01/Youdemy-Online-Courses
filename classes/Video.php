<?php
require_once 'Database.php';
require_once 'Cours.php';

class Video extends Course {
    private $url;

    public function __construct($id, $title, $description, $content, $image, $status, $url) {
        parent::__construct($id, $title, $description, $content, $image, 'VIDEO', $status);
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }

    public function afficheDetails() {
        echo "Titre : $this->title, Description : $this->description, URL : $this->url\n";
    }

    public function afficheCourse() {
        echo "Affichage du cours vidéo : $this->title\n";
    }

    public function ajouterCourse() {
        echo "Ajout d'un cours vidéo intitulé : $this->title\n";
    }
}
?>
