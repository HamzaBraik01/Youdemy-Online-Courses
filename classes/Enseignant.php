<?php
require_once 'Database.php';
require_once 'Utilisateur.php';

class Enseignant extends Utilisateur {
    // Constructeur
    public function __construct(string $nom, string $email, string $motDePasse, Role $role, string $status = 'active') {
        parent::__construct($nom, $email, $motDePasse, $role, $status);  
    }

    
    public function register(): void {
        // Enregistrer l'utilisateur dans la base de données
        $this->save();
        //echo "Teacher {$this->getNom()} registered.\n"; 
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

    
}