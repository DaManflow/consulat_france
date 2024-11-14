-- Insertion de données dans la table 'utilisateur'
INSERT INTO utilisateur (utilisateur_id, nom, prenom, email, mot_de_passe, nationalite, date_naissance, admin) VALUES 
(1, 'Martin', 'Jean', 'jean.martin@example.com', 'MotDePasse123!', 'Française', '1985-05-12', FALSE),
(2, 'Dupont', 'Sophie', 'sophie.dupont@example.com', 'SophiePass@89', 'Française', '1992-03-08', FALSE),
(3, 'Moreau', 'Pierre', 'pierre.moreau@example.com', 'PierrePass!99', 'Algérienne', '1987-07-25', FALSE),
(4, 'Durand', 'Marie', 'marie.durand@example.com', 'Marie#Durand22', 'Marocaine', '1995-01-10', FALSE),
(5, 'Petit', 'Luc', 'luc.petit@example.com', 'LucPetit987&', 'Sénégalaise', '1990-06-15', FALSE),
(6, 'Benoit', 'Claire', 'claire.benoit@example.com', 'BenoitC@2023', 'Ivoirienne', '1991-11-05', FALSE),
(7, 'Rousseau', 'Paul', 'paul.rousseau@example.com', 'PaulRoux*71', 'Camerounaise', '1980-02-22', FALSE),
(8, 'Joly', 'Emma', 'emma.joly@example.com', 'Emma!Joly1', 'Malienne', '1989-04-18', FALSE),
(9, 'Lambert', 'Lucie', 'lucie.lambert@example.com', 'Lucie#2021*', 'Nigérienne', '1994-09-02', FALSE),
(10, 'Garcia', 'Luis', 'luis.garcia@example.com', 'LuisGarcia*75', 'Mexicaine', '1990-08-30', FALSE),
(11, 'Lopez', 'Maria', 'maria.lopez@example.com', 'Lopez@Maria33', 'Espagnole', '1988-12-12', FALSE),
(12, 'Admin', 'Consulat', 'admin@consulat.fr', 'Admin*Secure01', 'Française', '1970-01-01', TRUE);

-- Insertion de données dans la table 'visa'
INSERT INTO demande_visa (demande_visa_id, utilisateur_id, numero_passeport,pays_emission, date_creation, date_expiration, date_depart, date_retour, motifs, status) VALUES 
(1, 1, '12AB34567', 'France','2018-05-12', '2028-05-12', '2023-12-01', '2024-01-15', 'tourisme', 'en cours'),
(2, 2, '34CD56789', 'France', '2017-07-18', '2027-07-18', '2023-11-20', '2024-01-05', 'affaires', 'en cours'),
(3, 3, '56EF78901', 'Canada', '2019-09-10', '2029-09-10', '2023-12-10', '2024-01-20', 'visite à la famille', 'acceptée'),
(4, 4, '78GH12345', 'Pérou','2016-10-05', '2026-10-05', '2023-11-25', '2024-02-10', 'études', 'refusée'),
(5, 5, '90IJ67890', 'Inde', '2020-06-25', '2030-06-25', '2023-12-05', '2024-01-15', 'sports', 'en cours'),
(6, 6, '12KL23456', 'Niger', '2018-03-15', '2028-03-15', '2023-12-20', '2024-02-05', 'culture', 'en cours'),
(7, 7, '34MN34567', 'Australie', '2019-02-12', '2029-02-12', '2023-11-28', '2024-01-12', 'tourisme', 'en cours');

-- Insertion de données dans la table 'gagnant_loterie'
INSERT INTO gagnant_loterie (utilisateur_id, date_gain) VALUES 
(3, '2023-11-15'),
(6, '2023-11-15'),
(7, '2023-11-15'),
(8, '2023-11-15'),
(10, '2023-11-15');

-- Insertion de données dans la table 'demande_contact'
INSERT INTO demande_contact (demande_contact_id, utilisateur_id, email, motif, description, date_creation) VALUES 
(1,2,'contact1@example.com', 'Demande d informations', 'Bonjour, je souhaiterais en savoir plus sur les visas disponibles pour les étudiants.', '2024-10-30'),
(2,1,'contact2@example.com', 'Problème de connexion', 'Je rencontre des difficultés pour accéder à mon compte, pourriez-vous m aider ?','2024-10-23'),
(3,7,'contact3@example.com', 'Question générale', 'Bonjour, quelles sont les documents requis pour une demande de visa d affaires ?', '2024-03-04'),
(4,6,'contact4@example.com', 'Demande de renseignements', 'Je souhaite savoir si une assurance est requise pour voyager en France.', '2024-11-06'),
(5,4, 'contact5@example.com', 'Assistance technique', 'Mon formulaire de demande de visa ne se soumet pas correctement, comment dois-je procéder ?', '2024-09-30');
