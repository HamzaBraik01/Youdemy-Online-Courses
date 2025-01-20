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
}
?>