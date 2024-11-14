DROP TABLE IF EXISTS profil_utilisateur;
DROP TABLE IF EXISTS document;
DROP TABLE IF EXISTS demande_visa;
DROP TABLE IF EXISTS gagnant_loterie;
DROP TABLE IF EXISTS demande_contact;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS loterie;
DROP TABLE IF EXISTS presse;

-- Table des utilisateurs
CREATE TABLE utilisateur (
    utilisateur_id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    nationalite VARCHAR(100) NOT NULL,
    theme_preference VARCHAR(10) DEFAULT 'clair',
    taille_texte SMALLINT DEFAULT 12,
    liens_soulignes BOOLEAN DEFAULT FALSE,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    admin BOOLEAN DEFAULT FALSE
);

-- Table des profils utilisateurs
CREATE TABLE profil_utilisateur (
    profil_id SERIAL PRIMARY KEY,
    utilisateur_id INTEGER REFERENCES utilisateur(utilisateur_id) ON DELETE CASCADE,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(100) NOT NULL
);

-- Table des demandes de visa
CREATE TABLE demande_visa (
    demande_visa_id SERIAL PRIMARY KEY,
    utilisateur_id INTEGER REFERENCES utilisateur(utilisateur_id) ON DELETE CASCADE,
    numero_passeport VARCHAR(50) NOT NULL,
    pays_emission VARCHAR(50) NOT NULL,
    date_expiration DATE NOT NULL,
    date_depart DATE NOT NULL,
    date_retour DATE NOT NULL,
    motifs VARCHAR(255),
    status VARCHAR(20) DEFAULT 'en_cours',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des documents associés aux demandes de visa
CREATE TABLE document (
    document_id SERIAL PRIMARY KEY,
    demande_visa_id INTEGER REFERENCES demande_visa(demande_visa_id) ON DELETE CASCADE,
    type_document VARCHAR(50) NOT NULL,
    chemin_fichier VARCHAR(255) NOT NULL,
    date_televersement TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table pour gérer les loteries
CREATE TABLE loterie (
    loterie_id SERIAL PRIMARY KEY,
    date_lancement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nombre_gagnants INTEGER NOT NULL,
    statut VARCHAR(20) DEFAULT 'ouverte'
);

-- Table pour les gagnants de la loterie
CREATE TABLE gagnant_loterie (
    gagnant_loterie_id SERIAL PRIMARY KEY,
    loterie_id INTEGER REFERENCES loterie(loterie_id) ON DELETE CASCADE,
    utilisateur_id INTEGER REFERENCES utilisateur(utilisateur_id) ON DELETE CASCADE,
    date_gain TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table pour les articles de presse
CREATE TABLE presse (
    presse_id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    auteur VARCHAR(100) NOT NULL
);

-- Table pour les messages de contact
CREATE TABLE demande_contact (
    demande_contact_id SERIAL PRIMARY KEY,
    utilisateur_id INTEGER REFERENCES utilisateur(utilisateur_id) ON DELETE SET NULL,
    email VARCHAR(100) NOT NULL,
    motif VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
