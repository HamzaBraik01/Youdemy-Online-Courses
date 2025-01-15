<?php
// Inclure la classe Database
require_once '../classes/Database.php';

try {
    $db = Database::getInstance();
    $pdo = $db->getConnection();

    echo "Connexion à la base de données réussie!\n";

    $stmt = $pdo->query("SELECT * FROM Utilisateur");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    foreach ($users as $user) {
        echo "Utilisateur: {$user['nom']} ({$user['email']})\n";
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>