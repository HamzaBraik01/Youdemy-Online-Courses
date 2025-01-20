<?php
require_once 'Database.php';
require_once 'Utilisateur.php';

class Enseignant extends Utilisateur {
    // Constructeur
    public function __construct(string $nom, string $email, string $motDePasse, Role $role, string $status = 'active') {
        parent::__construct($nom, $email, $motDePasse, $role, $status);  
    }

    
    public function register(): void {
        $this->save();
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

    
    public function consulterStatistiques(): array {
        $enseignantId = $_SESSION['user']['id'];
        $db = Database::getInstance()->getConnection();
        $queryCours = "SELECT COUNT(*) as total_cours FROM enseignant_cours WHERE id_enseignant = :id_enseignant";
        $stmtCours = $db->prepare($queryCours);
        $stmtCours->execute(['id_enseignant' => $enseignantId]);
        $totalCours = $stmtCours->fetch(PDO::FETCH_ASSOC)['total_cours'];
    
        // Requête pour récupérer le nombre total d'étudiants inscrits aux cours de l'enseignant
        $queryEtudiants = "
            SELECT COUNT(DISTINCT sc.id_etudiant) as total_etudiants 
            FROM student_courses sc
            JOIN enseignant_cours ec ON sc.id_cours = ec.id_cours
            WHERE ec.id_enseignant = :id_enseignant
        ";
        $stmtEtudiants = $db->prepare($queryEtudiants);
        $stmtEtudiants->execute(['id_enseignant' => $enseignantId]);
        $totalEtudiants = $stmtEtudiants->fetch(PDO::FETCH_ASSOC)['total_etudiants'];
    
        // Requête pour récupérer le nombre total de cours auxquels les étudiants sont inscrits
        $queryCoursInscrits = "
            SELECT COUNT(*) as total_cours_inscrits
            FROM student_courses sc
            JOIN enseignant_cours ec ON sc.id_cours = ec.id_cours
            WHERE ec.id_enseignant = :id_enseignant
        ";
        $stmtCoursInscrits = $db->prepare($queryCoursInscrits);
        $stmtCoursInscrits->execute(['id_enseignant' => $enseignantId]);
        $totalCoursInscrits = $stmtCoursInscrits->fetch(PDO::FETCH_ASSOC)['total_cours_inscrits'];
    
        // Requête pour récupérer le top 3 des cours les plus inscrits avec les détails
        $queryTopCours = "
            SELECT c.titre, c.image, cat.name as categorie, COUNT(sc.id_etudiant) as nb_inscriptions 
            FROM student_courses sc
            JOIN cours c ON sc.id_cours = c.id
            JOIN categorie cat ON c.categorie_id = cat.id
            JOIN enseignant_cours ec ON c.id = ec.id_cours
            WHERE ec.id_enseignant = :id_enseignant
            GROUP BY c.id
            ORDER BY nb_inscriptions DESC
            LIMIT 3
        ";
        $stmtTopCours = $db->prepare($queryTopCours);
        $stmtTopCours->execute(['id_enseignant' => $enseignantId]);
        $topCours = $stmtTopCours->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourner les statistiques
        return [
            'total_cours' => $totalCours,
            'total_etudiants' => $totalEtudiants,
            'total_cours_inscrits' => $totalCoursInscrits, 
            'top_cours' => $topCours
        ];
    }

    
}