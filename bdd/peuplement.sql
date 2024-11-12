-- Supprimer les données insérées précédemment dans les tables
DELETE FROM demande_de_visa;
DELETE FROM passeport;
DELETE FROM visa;
DELETE FROM personne;
DELETE FROM nationalite;
DELETE FROM demande_de_contact;
DELETE FROM motif;
DELETE FROM loterie;

-- Insérer des nationalités exemples
INSERT INTO nationalite (id_nationalite, nom_pays, est_autorise) 
VALUES  (5,'France', TRUE),
        (1, 'Pays1', TRUE),
        (2, 'Pays2', TRUE),
        (3, 'Pays3', TRUE),
        (4, 'Pays4', FALSE);

-- Insérer des motifs
INSERT INTO motif (id_motif, motif, est_valide) 
VALUES (1, 'Demande d informations', TRUE),
       (2, 'Problème technique', FALSE),
       (3, 'Autre', TRUE);

-- Insérer l'utilisateur admin dans la table 'personne'
INSERT INTO personne (id_personne, est_admin, nom, prenom, email, mdp, a_carte_verte)
VALUES  (1, TRUE, 'admin', 'admin', 'admin@admin.com', 'admin123', FALSE),
        (2, FALSE, 'Nom-A', 'Prenom-A', 'nom-prenom-a@domaine.fr', 'a123AZE_', FALSE);

-- Insérer des demandes de visa pour l'admin (exemple avec des PDF fictifs)
INSERT INTO demande_de_visa (id_personne, date_demande_de_visa, id_nationalite, depart_voyage, retour_voyage, objet_voyage, photo_identite, est_terminee, pdf_demande_de_visa)
VALUES 
(1, '2024-10-01', 1, '2024-12-01', '2025-01-01', 'Voyage d affaires', 'photo_admin1.jpg', FALSE, 'https://example.com/visa_demande_1.pdf'),
(1, '2024-11-01', 1, '2025-01-15', '2025-02-15', 'Voyage touristique', 'photo_admin2.jpg', FALSE, 'https://example.com/visa_demande_2.pdf');

-- Insérer des passeports pour l'admin
INSERT INTO passeport (id_personne, n_passeport, date_creation_passeport, date_validite_passeport, photocopie_passeport)
VALUES 
(1, 'P123456789', '2024-01-01', '2034-01-01', 'https://example.com/passeport_1.pdf'),
(1, 'P987654321', '2024-06-01', '2034-06-01', 'https://example.com/passeport_2.pdf');

-- Insérer des visas pour l'admin
INSERT INTO visa (id_personne, pdf_du_visa, pdf_refus_visa)
VALUES 
(1, 'https://example.com/visa_1.pdf', 'https://example.com/refus_visa_1.pdf'),
(1, 'https://example.com/visa_2.pdf', 'https://example.com/refus_visa_2.pdf');

-- Insérer une demande de contact pour l'admin
INSERT INTO demande_de_contact (date_demande_de_contact, email, id_motif1, id_motif2, id_motif3, description_detaillee)
VALUES 
('2024-10-15', 'admin@admin.com', 1, 2, NULL, 'Demande d information concernant le visa');