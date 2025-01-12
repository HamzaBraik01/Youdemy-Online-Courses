# Youdemy: Plateforme de cours en ligne

## Description du Projet
Youdemy est une plateforme interactive d'apprentissage en ligne conçue pour les étudiants et les enseignants. Elle offre un accès simplifié à un large catalogue de cours tout en permettant une gestion avancée pour les enseignants et une administration efficace pour les administrateurs.

## Fonctionnalités Principales

### Partie Front Office

#### Visiteur
- Accès au catalogue des cours avec pagination.
- Recherche de cours par mots-clés.
- Création d'un compte avec choix du rôle (Étudiant ou Enseignant).

#### Étudiant
- Visualisation du catalogue des cours.
- Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
- Inscription à un cours après authentification.
- Accès à une section "Mes cours" regroupant les cours rejoints.

#### Enseignant
- Ajout de nouveaux cours avec les informations suivantes :
  - Titre, description, contenu (vidéo ou document), tags, et catégorie.
- Gestion des cours (modification, suppression, consultation des inscriptions).
- Accès à une section "Statistiques" comprenant :
  - Nombre d'étudiants inscrits.
  - Nombre total de cours.

### Partie Back Office

#### Administrateur
- Validation des comptes enseignants.
- Gestion des utilisateurs (activation, suspension, suppression).
- Gestion des contenus (cours, catégories et tags).
- Insertion en masse de tags.
- Accès à des statistiques globales :
  - Nombre total de cours.
  - Répartition des cours par catégorie.
  - Le cours avec le plus d'étudiants.
  - Les Top 3 enseignants.

### Fonctionnalités Transversales
- Relation many-to-many entre les cours et les tags.
- Polymorphisme appliqué aux méthodes d'ajout et d'affichage des cours.
- Système d'authentification et d'autorisation pour protéger les routes sensibles.
- Contrôle d'accès basé sur le rôle de l'utilisateur.

### Bonus
- Recherche avancée avec filtres (catégorie, tags, auteur).
- Statistiques avancées (taux d'engagement par cours, catégories populaires).
- Système de notification (validation de compte enseignant, inscription confirmée à un cours).
- Système de commentaires ou d'évaluations sur les cours.
- Génération de certificats PDF de complétion.

## Architecture et Exigences Techniques
- Respect des principes de la POO : encapsulation, héritage, polymorphisme.
- Base de données relationnelle avec gestion des relations (one-to-many, many-to-many).
- Sessions PHP pour la gestion des utilisateurs connectés.
- Validation côté client (HTML5, JavaScript) et côté serveur (PHP) pour éviter les attaques XSS, CSRF, et SQL Injection.
- Utilisation de requêtes préparées pour sécuriser les interactions avec la base de données.

## Diagrammes UML
- Diagramme des cas d'utilisation.
- Diagramme de classes.

## Installation

1. Clonez le repository :
```bash
https://github.com/HamzaBraik01/Youdemy-Online-Courses.git
```

2. Configurez la base de données :
   - Importez le fichier SQL fourni dans votre serveur de base de données.

3. Configurez les fichiers de configuration :
   - Mettez à jour les informations de connexion à la base de données dans `config/database.php`.

4. Lancez un serveur local (exemple avec PHP) :
```bash
php -S localhost:8000
```

5. Accédez à l'application via [http://localhost:8000](http://localhost:8000).

## Technologies Utilisées
- **Frontend** : HTML5, CSS3, JavaScript (natif).
- **Backend** : PHP 8.2.12.
- **Base de Données** : MySQL.

## Auteur
Hamza Braik

## Licence
Ce projet est sous licence MIT. Consultez le fichier `LICENSE` pour plus d'informations.

---
**Important** : Ce projet respecte les normes de développement web, y compris les standards W3C et WCAG pour l'accessibilité.
