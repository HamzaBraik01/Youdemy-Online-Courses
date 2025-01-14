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
}
?>