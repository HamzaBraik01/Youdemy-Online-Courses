<?php
class Cours {
    public int $id;
    public string $titre;
    public string $description;
    public string $contenu;
    public string $image;
    public Categorie $categorie;
    public array $tags = []; // Array of Tag objects

    public function __construct(int $id, string $titre, string $description, string $contenu, string $image, Categorie $categorie) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->image = $image;
        $this->categorie = $categorie;
    }

    public function afficherDetails(): void {
    }
}
?>