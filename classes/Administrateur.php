<?php
require_once 'Database.php';
require_once 'Utilisateur.php';

class Administrateur extends Utilisateur {

    public function __construct(string $nom, string $email, string $motDePasse, Role $role, string $status = 'active') {
        parent::__construct($nom, $email, $motDePasse, $role, $status);
    }
    public function register(): void {
        // Enregistrer l'utilisateur dans la base de données
        $this->save();
        echo "Admin {$this->nom} registered.\n";
    }

    public function validerCompteEnseignant(?int $id = null, ?string $action = null): array {
        $db = Database::getInstance()->getConnection();

        if ($id !== null && $action !== null) {
            $nouveauStatut = ($action === 'valider') ? 'active' : 'suspendu';

            $stmt = $db->prepare("
                UPDATE Utilisateur 
                SET status = :status 
                WHERE id = :id
                AND role_id = (SELECT id FROM Role WHERE role = 'Enseignant')
            ");
            $stmt->bindParam(':status', $nouveauStatut);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Le compte a été " . ($action === 'valider' ? 'validé' : 'refusé') . " avec succès.";
            } else {
                $_SESSION['error'] = "Une erreur s'est produite lors de la mise à jour du statut.";
            }
        }

        // Récupérer la liste des enseignants en attente
        $stmt = $db->prepare("
            SELECT id, nom, email, status 
            FROM Utilisateur 
            WHERE role_id = (SELECT id FROM Role WHERE role = 'Enseignant') 
            AND status = 'en attente'
        ");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gererUtilisateurs(): array {
        $db = Database::getInstance()->getConnection();
    
        $stmtEnseignants = $db->prepare("
            SELECT id, nom, email, status 
            FROM Utilisateur 
            WHERE role_id = (SELECT id FROM Role WHERE role = 'Enseignant')
        ");
        $stmtEnseignants->execute();
        $enseignants = $stmtEnseignants->fetchAll(PDO::FETCH_ASSOC);
    
        $stmtEtudiants = $db->prepare("
            SELECT id, nom, email, status 
            FROM Utilisateur 
            WHERE role_id = (SELECT id FROM Role WHERE role = 'Etudiant')
        ");
        $stmtEtudiants->execute();
        $etudiants = $stmtEtudiants->fetchAll(PDO::FETCH_ASSOC);
    
        return [
            'enseignants' => $enseignants,
            'etudiants' => $etudiants
        ];
    }

    public function gererContenu(): void {
    }

    public function insererTagsEnMasse(array $tags): array {
        $db = Database::getInstance()->getConnection();
        $insertedTags = [];
        $duplicateTags = [];

        foreach ($tags as $tag) {
            // Vérifier si le tag existe déjà
            $stmt = $db->prepare("SELECT id FROM Tag WHERE name = :name");
            $stmt->bindParam(':name', $tag);
            $stmt->execute();

            if ($stmt->fetch()) {
                $duplicateTags[] = $tag;
            } else {
                // Insérer le tag s'il n'existe pas
                $stmt = $db->prepare("INSERT INTO Tag (name) VALUES (:name)");
                $stmt->bindParam(':name', $tag);
                if ($stmt->execute()) {
                    $insertedTags[] = $tag;
                }
            }
        }

        return [
            'insertedTags' => $insertedTags,
            'duplicateTags' => $duplicateTags
        ];
    }

    public function consulterStatistiquesGlobales(): array {
        $db = Database::getInstance()->getConnection();

        //  le nombre total de cours
        $stmt = $db->query("SELECT COUNT(*) FROM Cours");
        $totalCours = $stmt->fetchColumn();

        //  le nombre total d'étudiants
        $stmt = $db->query("SELECT COUNT(*) FROM Utilisateur WHERE role_id = (SELECT id FROM Role WHERE role = 'Etudiant')");
        $totalEtudiants = $stmt->fetchColumn();

        // le nombre total d'enseignants
        $stmt = $db->query("SELECT COUNT(*) FROM Utilisateur WHERE role_id = (SELECT id FROM Role WHERE role = 'Enseignant')");
        $totalEnseignants = $stmt->fetchColumn();

        // le nombre total de tags
        $stmt = $db->query("SELECT COUNT(*) FROM Tag");
        $totalTags = $stmt->fetchColumn();

        // Récupérer la répartition des cours avec les informations supplémentaires
        $stmt = $db->query("
        SELECT 
            Cours.titre AS name,
            Utilisateur.nom AS enseignant,
            COUNT(Student_Courses.id_etudiant) AS total,
            Categorie.name AS categorie,
            CASE 
                WHEN Cours.status = 1 THEN 'Actif'
                ELSE 'Inactif'
            END AS status
        FROM 
            Cours
        JOIN 
            Categorie ON Cours.categorie_id = Categorie.id
        JOIN 
            Enseignant_Cours ON Cours.id = Enseignant_Cours.id_cours
        JOIN 
            Utilisateur ON Enseignant_Cours.id_enseignant = Utilisateur.id
        LEFT JOIN 
            Student_Courses ON Cours.id = Student_Courses.id_cours
        WHERE 
            Utilisateur.role_id = 2  -- Filtrer uniquement les enseignants
        GROUP BY 
            Cours.id, Categorie.name, Utilisateur.nom, Cours.status;
        ");

        $repartitionCours = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Récupérer le top 3 des enseignants avec le plus de cours
        $stmt = $db->query("
            SELECT Utilisateur.nom, COUNT(Enseignant_Cours.id_cours) AS total_cours
            FROM Enseignant_Cours
            JOIN Utilisateur ON Enseignant_Cours.id_enseignant = Utilisateur.id
            GROUP BY Utilisateur.nom
            ORDER BY total_cours DESC
            LIMIT 3
        ");
        $topEnseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retourner toutes les statistiques dans un tableau associatif
        return [
            'totalCours' => $totalCours,
            'totalEtudiants' => $totalEtudiants,
            'totalEnseignants' => $totalEnseignants,
            'totalTags' => $totalTags,
            'repartitionCours' => $repartitionCours,
            'topEnseignants' => $topEnseignants
        ];
    }

    
}
?>