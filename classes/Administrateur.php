<?php
class Administrateur extends Utilisateur {
    public function register(): void {
        // Enregistrer l'utilisateur dans la base de données
        $this->save();
        echo "Admin {$this->nom} registered.\n";
    }

    public function validerCompteEnseignant(): void {
    }

    public function gererUtilisateurs(): void {
    }

    public function gererContenu(): void {
    }

    public function insererTagsEnMasse(): void {
    }

    public function consulterStatistiquesGlobales(): void {
    }

    public function seConnecter(): void {
        echo "Admin {$this->nom} connected.\n";
    }

    public function seDeconnecter(): void {
        echo "Admin {$this->nom} disconnected.\n";
    }
}
?>