CREATE DATABASE Youdemy;

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
    FOREIGN KEY (role_id) REFERENCES Role(id)
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
    categorie_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id)
);

-- Table: Enseignant_Cours
CREATE TABLE Enseignant_Cours (
    id_enseignant INT NOT NULL,
    id_cours INT NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_enseignant, id_cours),
    FOREIGN KEY (id_enseignant) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_cours) REFERENCES Cours(id)
);

-- Table: Course_Tag
CREATE TABLE Course_Tag (
    id_tag INT NOT NULL,
    id_cours INT NOT NULL,
    PRIMARY KEY (id_tag, id_cours),
    FOREIGN KEY (id_tag) REFERENCES Tag(id),
    FOREIGN KEY (id_cours) REFERENCES Cours(id)
);

-- Table: Content
CREATE TABLE Content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES Categorie(id)
);

-- Table: Video ()
CREATE TABLE Video (
    content_id INT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    FOREIGN KEY (content_id) REFERENCES Content(id)
);

-- Table: Context ()
CREATE TABLE Context (
    content_id INT PRIMARY KEY,
    objectif TEXT NOT NULL,
    FOREIGN KEY (content_id) REFERENCES Content(id)
);

-- Table: Student_Courses
CREATE TABLE Student_Courses (
    id_etudiant INT NOT NULL,
    id_cours INT NOT NULL,
    PRIMARY KEY (id_etudiant, id_cours),
    FOREIGN KEY (id_etudiant) REFERENCES Utilisateur(id),
    FOREIGN KEY (id_cours) REFERENCES Cours(id)
);
