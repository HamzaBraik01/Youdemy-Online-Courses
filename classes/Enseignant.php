<?php
class Enseignant extends Utilisateur {
    public int $approve;

    public function __construct(int $id, string $nom, string $email, string $motDePasse, Role $role, int $approve) {
        parent::__construct($id, $nom, $email, $motDePasse, $role);
        $this->approve = $approve;
    }

    public function register(): void {
        // Enregistrer l'utilisateur dans la base de données
        $this->save();
        echo "Teacher {$this->nom} registered.\n";
    }

    public function listeCoursCrees(): array {
        return [];
    }

    public function ajouterCours(): void {
    }

    public function modifierCours(): void {
    }

    public function supprimerCours(): void {
    }

    public function consulterStatistiques(): void {
    }

    public function seConnecter(): void {
        echo "Teacher {$this->nom} connected.\n";
    }

    public function seDeconnecter(): void {
        echo "Teacher {$this->nom} disconnected.\n";
    }
}
?>