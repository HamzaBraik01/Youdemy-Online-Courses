<?php
abstract class Content {
    public int $id;
    public string $titre;
    public string $description;
    public array $tags = []; // Array of Tag objects
    public Categorie $categorie;

    public function __construct(int $id, string $titre, string $description, Categorie $categorie) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie = $categorie;
    }

    // Abstract methods for subclasses to implement
    abstract public function ajouterContenu(): void;

    abstract public function afficherContenu(): void;
}
?>