<?php
class Administrateur extends Utilisateur {
    public function register(): void {
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
}
?>