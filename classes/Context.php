<?php
class Context extends Content {
    public string $objectif;

    public function __construct(int $id, string $titre, string $description, Categorie $categorie, string $objectif) {
        parent::__construct($id, $titre, $description, $categorie);
        $this->objectif = $objectif;
    }

    public function ajouterContenu(): void {
        echo "Objective content '{$this->titre}' added.\n";
    }

    public function afficherContenu(): void {
        echo "Displaying objective content: {$this->titre}, Objective: {$this->objectif}\n";
    }
}
?>