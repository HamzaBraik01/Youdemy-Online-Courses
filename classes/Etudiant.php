<?php
class Etudiant extends Utilisateur {
    public function register(): void {
        // Enregistrer l'utilisateur dans la base de données
        $this->save();
        echo "Student {$this->nom} registered.\n";
    }

    public function listeCoursInscrits(): array {
        return [];
    }

    public function sInscrireAuCours(): void {
    }

    public function consulterMesCours(): array {
        return [];
    }

    public function seConnecter(): void {
        echo "Student {$this->nom} connected.\n";
    }

    public function seDeconnecter(): void {
        echo "Student {$this->nom} disconnected.\n";
    }
}
?>