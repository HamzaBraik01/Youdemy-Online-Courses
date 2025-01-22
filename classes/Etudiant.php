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

    public function listeCours(int $limit = 6, int $page = 1, ?int $category_id = null): array {
        $db = Database::getInstance()->getConnection();

        // Calculer l'offset pour la pagination
        $offset = ($page - 1) * $limit;

        // Requête de base pour les cours avec jointure pour récupérer le nom de l'enseignant
        $query = "
            SELECT 
                cours.id AS cours_id,
                cours.titre AS cours_titre,
                cours.description AS cours_description,
                cours.type AS cours_type,
                cours.image AS cours_image,
                cours.status AS cours_status,
                categorie.name AS categorie_name,
                utilisateur.nom AS enseignant_nom
            FROM 
                cours
            JOIN 
                categorie ON cours.categorie_id = categorie.id
            JOIN 
                enseignant_cours ON cours.id = enseignant_cours.id_cours
            JOIN 
                utilisateur ON enseignant_cours.id_enseignant = utilisateur.id
            WHERE 
                cours.status = 1
        ";

        // Ajouter le filtre par catégorie si une catégorie est sélectionnée
        if ($category_id) {
            $query .= " AND cours.categorie_id = :category_id";
        }

        // Ajouter la pagination
        $query .= " LIMIT :limit OFFSET :offset";

        // Préparer et exécuter la requête
        $stmt = $db->prepare($query);
        if ($category_id) {
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        // Retourner les cours sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listeCoursInscrits(): array {
        $db = Database::getInstance()->getConnection();
    
        // Récupérer l'ID de l'étudiant depuis la session
        $etudiant_id = $_SESSION['user']['id'];
    
        // Requête pour récupérer les cours auxquels l'étudiant est inscrit
        $query = "
            SELECT 
                cours.id AS cours_id,
                cours.titre AS cours_titre,
                cours.description AS cours_description,
                cours.type AS cours_type,
                cours.image AS cours_image,
                cours.status AS cours_status,
                categorie.name AS categorie_name,
                utilisateur.nom AS enseignant_nom
            FROM 
                cours
            JOIN 
                categorie ON cours.categorie_id = categorie.id
            JOIN 
                enseignant_cours ON cours.id = enseignant_cours.id_cours
            JOIN 
                utilisateur ON enseignant_cours.id_enseignant = utilisateur.id
            JOIN 
                student_courses ON cours.id = student_courses.id_cours
            WHERE 
                student_courses.id_etudiant = :etudiant_id
        ";
    
        // Préparer et exécuter la requête
        $stmt = $db->prepare($query);
        $stmt->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Retourner les cours sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sInscrireAuCours(int $etudiant_id, int $cours_id): void {
        $db = Database::getInstance()->getConnection();
    
        // Vérifier si l'étudiant est déjà inscrit à ce cours
        $stmt = $db->prepare("SELECT * FROM Student_Courses WHERE id_etudiant = :etudiant_id AND id_cours = :cours_id");
        $stmt->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
        $stmt->bindParam(':cours_id', $cours_id, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->fetch()) {
            throw new Exception("Vous êtes déjà inscrit à ce cours.");
        }
    
        // Inscrire l'étudiant au cours
        $stmt = $db->prepare("INSERT INTO Student_Courses (id_etudiant, id_cours) VALUES (:etudiant_id, :cours_id)");
        $stmt->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
        $stmt->bindParam(':cours_id', $cours_id, PDO::PARAM_INT);
    
        if (!$stmt->execute()) {
            throw new Exception("Erreur lors de l'inscription au cours.");
        }
    }

    public function consulterMesCours(): array {
        return [];
    }

    
}
?>