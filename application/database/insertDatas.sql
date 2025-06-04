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

