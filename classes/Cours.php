<?php

abstract class Course {
    protected $id;
    protected $title;
    protected $description;
    protected $content;
    protected $image;
    protected $type;
    protected $status;

    // Constructeur
    public function __construct($id, $title, $description, $content, $image, $type, $status) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->image = $image;
        $this->type = $type;
        $this->status = $status;
    }

    // Méthodes
    public function afficheDetails() {
        
    }

    public function afficheContent() {
        
    }

    public function ajouterContent() {
    }
}
?>