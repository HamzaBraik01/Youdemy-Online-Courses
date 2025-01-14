<?php
class Video extends Content {
    public string $url;

    public function __construct(int $id, string $titre, string $description, Categorie $categorie, string $url) {
        parent::__construct($id, $titre, $description, $categorie);
        $this->url = $url;
    }

    public function ajouterContenu(): void {
        echo "Video content '{$this->titre}' added.\n";
    }

    public function afficherContenu(): void {
        echo "Displaying video: {$this->titre}, URL: {$this->url}\n";
    }
}
?>