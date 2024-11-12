\i delete_tables.sql

-- Script de création de base de données pour la gestion de demandes de visa

-- Création de la table 'personne'
CREATE TABLE personne (
    id_personne SERIAL PRIMARY KEY,
    est_admin BOOLEAN DEFAULT FALSE,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    a_carte_verte BOOLEAN DEFAULT FALSE,
    date_a_carte_verte DATE
);

-- Création de la table 'nationalite'
CREATE TABLE nationalite (
    id_nationalite SERIAL PRIMARY KEY,
    nom_pays VARCHAR(100) UNIQUE NOT NULL,
    est_autorise BOOLEAN DEFAULT TRUE
);

-- Création de la table 'demande_de_visa'
CREATE TABLE demande_de_visa (
    id_demande_de_visa SERIAL PRIMARY KEY,
    id_personne INTEGER NOT NULL REFERENCES personne(id_personne) ON DELETE CASCADE,
    date_demande_de_visa DATE NOT NULL,
    id_nationalite INTEGER REFERENCES nationalite(id_nationalite) ON DELETE SET NULL,
    depart_voyage DATE,
    retour_voyage DATE,
    objet_voyage TEXT,
    photo_identite VARCHAR(255),
    est_terminee BOOLEAN DEFAULT FALSE,
    pdf_demande_de_visa VARCHAR(255)
);

-- Création de la table 'passeport'
CREATE TABLE passeport (
    id_passeport SERIAL PRIMARY KEY,
    id_personne INTEGER NOT NULL REFERENCES personne(id_personne) ON DELETE CASCADE,
    n_passeport VARCHAR(20) UNIQUE NOT NULL,
    date_creation_passeport DATE NOT NULL,
    date_validite_passeport DATE NOT NULL,
    photocopie_passeport VARCHAR(255)
);

-- Création de la table 'visa'
CREATE TABLE visa (
    id_visa SERIAL PRIMARY KEY,
    id_personne INTEGER NOT NULL REFERENCES personne(id_personne) ON DELETE CASCADE,
    pdf_du_visa VARCHAR(255),
    pdf_refus_visa VARCHAR(255)
);

-- Création de la table 'motif' pour les motifs de contact
CREATE TABLE motif (
    id_motif SERIAL PRIMARY KEY,
    motif VARCHAR(255) NOT NULL,
    est_valide BOOLEAN DEFAULT TRUE
);

-- Création de la table 'demande_de_contact' qui référence plusieurs motifs
CREATE TABLE demande_de_contact (
    id_demande_de_contact SERIAL PRIMARY KEY,
    date_demande_de_contact DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    id_motif1 INTEGER REFERENCES motif(id_motif) ON DELETE SET NULL,
    id_motif2 INTEGER REFERENCES motif(id_motif) ON DELETE SET NULL,
    id_motif3 INTEGER REFERENCES motif(id_motif) ON DELETE SET NULL,
    description_detaillee TEXT
);

-- Création de la table 'loterie'
CREATE TABLE loterie (
    id_loterie SERIAL PRIMARY KEY,
    date_loterie DATE NOT NULL,
    nb_personnes_tirees INTEGER NOT NULL
);
