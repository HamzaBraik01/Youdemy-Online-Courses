<?php
require_once 'Database.php';
require_once 'Utilisateur.php';
class Etudiant extends Utilisateur {

    public function __construct(string $nom, string $email, string $motDePasse, Role $role, string $status = 'active') {
        parent::__construct($nom, $email, $motDePasse, $role, $status);
    }

    public function register(): void {
        $this->save();
        //echo "Student {$this->nom} registered.\n";
    }

    public function listeCoursInscrits(): array {
        return [];
    }

    public function sInscrireAuCours(): void {
    }

    public function consulterMesCours(): array {
        return [];
    }

    
}
?>