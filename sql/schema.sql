-- Création de la base de données
CREATE DATABASE Youdemy;

-- Utilisation de la base de données
USE Youdemy;

-- Table: Role
CREATE TABLE Role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('Administrateur', 'Enseignant', 'Etudiant') NOT NULL
);

-- Table: Utilisateur
CREATE TABLE Utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    motDePasse VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    status ENUM('active', 'suspendu', 'en attente') DEFAULT 'active',
    FOREIGN KEY (role_id) REFERENCES Role(id) ON DELETE CASCADE
);

-- Table: Categorie
CREATE TABLE Categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Table: Tag
CREATE TABLE Tag (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Table: Cours
CREATE TABLE Cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    contenu TEXT,
    image VARCHAR(255),
    status TINYINT(1) DEFAULT 1,
    categorie_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id) ON DELETE CASCADE
);

-- Table: Enseignant_Cours
CREATE TABLE Enseignant_Cours (
    id_enseignant INT NOT NULL,
    id_cours INT NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_enseignant, id_cours),
    FOREIGN KEY (id_enseignant) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES Cours(id) ON DELETE CASCADE
);

-- Table: Course_Tag
CREATE TABLE Course_Tag (
    id_tag INT NOT NULL,
    id_cours INT NOT NULL,
    PRIMARY KEY (id_tag, id_cours),
    FOREIGN KEY (id_tag) REFERENCES Tag(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES Cours(id) ON DELETE CASCADE
);

-- Table: Content
CREATE TABLE Content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id) ON DELETE CASCADE
);

-- Table: Video
CREATE TABLE Video (
    content_id INT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    FOREIGN KEY (content_id) REFERENCES Content(id) ON DELETE CASCADE
);

-- Table: Context
CREATE TABLE Context (
    content_id INT PRIMARY KEY,
    objectif TEXT NOT NULL,
    FOREIGN KEY (content_id) REFERENCES Content(id) ON DELETE CASCADE
);

-- Table: Student_Courses
CREATE TABLE Student_Courses (
    id_etudiant INT NOT NULL,
    id_cours INT NOT NULL,
    PRIMARY KEY (id_etudiant, id_cours),
    FOREIGN KEY (id_etudiant) REFERENCES Utilisateur(id) ON DELETE CASCADE,
    FOREIGN KEY (id_cours) REFERENCES Cours(id) ON DELETE CASCADE
);

-- Insertion des rôles par défaut
INSERT INTO Role (role) VALUES 
    ('Administrateur'), 
    ('Enseignant'), 
    ('Etudiant');

-- Insertion d'un utilisateur administrateur par défaut
INSERT INTO Utilisateur (nom, email, motDePasse, role_id) VALUES 
    ('Admin', 'admin@admin.com', '$2y$10$n2efksBeVtKlfWbSNLKKfeLNELB3VoTPsaw72boNC3xmHFxxC8GT2', 1);


ALTER TABLE Cours
ADD COLUMN type ENUM('VIDEO', 'CONTEXTE') NOT NULL AFTER contenu;

DROP TABLE IF EXISTS Context, Video, Content;

-- Table pour les vidéos
CREATE TABLE Video (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    cours_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(id)
);

-- Table pour les contextes
CREATE TABLE Contexte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    objectif TEXT NOT NULL,
    cours_id INT NOT NULL,
    FOREIGN KEY (cours_id) REFERENCES Cours(id)
);