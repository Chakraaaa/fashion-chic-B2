INSERT INTO ROLE (libelle) VALUES
('admin'),
('gerant'),
('commercial'),
('manager'),
('preparateur'),
('envoyeur');


INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, id_role)
VALUES
('Martin', 'Jean', 'admin@fashionchic.com', '123', 1);

-- Gérant (id_role = 2)
INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, id_role)
VALUES
('Dubois', 'Marie', 'gerant@fashionchic.com', '123', 2);

-- Commerciaux (id_role = 3)
INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, id_role)
VALUES
('Dupont', 'Pierre', 'commercial1@fashionchic.com', '123', 3),
('Durand', 'Sophie', 'commercial2@fashionchic.com', '123', 3);

-- Manager (id_role = 4)
INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, id_role)
VALUES
('Leroy', 'Julie', 'manager@fashionchic.com', '123', 4);

-- Préparateurs (id_role = 5)
INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, id_role)
VALUES
('Moreau', 'Luc', 'preparateur1@fashionchic.com', '123', 5),
('Bernard', 'Emma', 'preparateur2@fashionchic.com', '123', 5);

-- Envoyeur (id_role = 6)
INSERT INTO UTILISATEUR (nom, prenom, email, mot_de_passe, id_role)
VALUES
('Petit', 'Thomas', 'envoyeur@fashionchic.com', '123', 6);


INSERT INTO CLIENT (nom, adresse, telephone, email, id_commercial) VALUES
('Boutique Élégance', '12 rue Lafayette, Paris', '0145001122', 'contact@elegance.fr', 1),
('Mode & Co', '45 avenue Montaigne, Paris', '0145789632', 'info@modeco.fr', 2),
('Chic Urbain', '23 boulevard Haussmann, Paris', '0178901122', 'chic@urbain.fr', 1),
('Style Avenue', '89 rue de Rennes, Paris', '0155567788', 'contact@styleavenue.fr', 2);

INSERT INTO produit (reference, nom, description, categorie, genre, taille, couleur, saison, marque, prix_achat, prix_vente, quantite, seuil_reappro, ean, actif)
VALUES
	('TSH001', 'T-Shirt Basique', 'T-shirt coton blanc col rond', 'T-Shirt', 'Homme', 'M', 'Blanc', 'PE2025', 'BasicCo', 5.00, 14.99, 120, 20, '1234567890001', 1),
	('TSH002', 'T-Shirt Basique', 'T-shirt coton noir col rond', 'T-Shirt', 'Femme', 'S', 'Noir', 'PE2025', 'BasicCo', 5.00, 14.99, 85, 15, '1234567890002', 1),
	('JNS001', 'Jean Slim', 'Jean coupe slim bleu', 'Jean', 'Homme', '38', 'Bleu', 'H2024', 'DenimX', 18.00, 49.90, 60, 10, '1234567890003', 1),
	('JNS002', 'Jean Regular', 'Jean coupe droite brut', 'Jean', 'Femme', '40', 'Bleu Foncé', 'H2024', 'DenimX', 19.50, 54.90, 70, 12, '1234567890004', 1),
	('ROB001', 'Robe Évasée', 'Robe légère imprimée fleurs', 'Robe', 'Femme', 'M', 'Rouge', 'PE2025', 'Élégance', 22.00, 59.00, 40, 8, '1234567890005', 1),
	('CHE001', 'Chemise Lin', 'Chemise en lin col mao', 'Chemise', 'Homme', 'L', 'Beige', 'PE2025', 'UrbanWear', 15.00, 39.99, 50, 10, '1234567890006', 1),
	('VST001', 'Veste Cuir', 'Veste motard cuir véritable', 'Veste', 'Homme', 'XL', 'Noir', 'H2024', 'Cuir&Style', 80.00, 149.00, 15, 3, '1234567890007', 1),
	('PL001', 'Polo Sport', 'Polo technique respirant', 'Polo', 'Homme', 'M', 'Bleu Marine', 'PE2025', 'Athletik', 12.00, 32.90, 90, 15, '1234567890008', 1),
	('JUP001', 'Jupe Midi', 'Jupe fluide taille haute', 'Jupe', 'Femme', 'M', 'Vert Sauge', 'PE2025', 'Élégance', 17.00, 45.00, 35, 5, '1234567890009', 1),
	('DOW001', 'Doudoune Légère', 'Doudoune sans manches', 'Manteau', 'Mixte', 'L', 'Gris', 'H2024', 'WarmCo', 30.00, 79.99, 25, 5, '1234567890010', 1);
