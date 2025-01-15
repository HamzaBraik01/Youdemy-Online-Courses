<?php
abstract class Utilisateur {
    public int $id;
    public string $nom;
    public string $email;
    public string $motDePasse;
    public Role $role;

    public function __construct(int $id, string $nom, string $email, string $motDePasse, Role $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }

    public function seConnecter(): void {
        echo "User {$this->nom} connected.\n";
    }

    public function seDeconnecter(): void {
        echo "User {$this->nom} disconnected.\n";
    }

    abstract public function register(): void;
    // Méthode pour enregistrer l'utilisateur dans la base de données
    protected function save(): void {
        $db = Database::getInstance()->getConnection();

        // Hasher le mot de passe
        $motDePasseHash = password_hash($this->motDePasse, PASSWORD_BCRYPT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $db->prepare("INSERT INTO Utilisateur (nom, email, motDePasse, role_id) VALUES (:nom, :email, :motDePasse, :role_id)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':motDePasse', $motDePasseHash);
        $stmt->bindParam(':role_id', $this->role->id);
        $stmt->execute();

        $this->id = $db->lastInsertId();
    }
}
?>