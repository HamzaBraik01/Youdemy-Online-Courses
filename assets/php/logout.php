<?php
session_start(); 

if (isset($_SESSION['user'])) {
    require_once '../../classes/Database.php';
    require_once '../../classes/Utilisateur.php';
    require_once '../../classes/Role.php';
    require_once '../../classes/Administrateur.php';
    require_once '../../classes/Enseignant.php';
    require_once '../../classes/Etudiant.php';

    $userData = $_SESSION['user'];

    $role = new Role($userData['role_id'], $userData['role']);
    $user = null;

    switch ($userData['role']) {
        case 'Administrateur':
            $user = new Administrateur($userData['nom'], $userData['email'], '', $role, $userData['status']);
            break;
        case 'Enseignant':
            $user = new Enseignant($userData['nom'], $userData['email'], '', $role, $userData['status']);
            break;
        case 'Etudiant':
            $user = new Etudiant($userData['nom'], $userData['email'], '', $role, $userData['status']);
            break;
        default:
            header('Location: ../../public/login.php');
            exit();
    }

    $user->setId($userData['id']);

    $user->seDeconnecter();
}

header('Location: ../../public/login.php');
exit();
?>