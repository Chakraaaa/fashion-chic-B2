INSERT INTO ROLE (libelle) VALUES
							   ('admin'),
							   ('gerant'),
							   ('commercial'),
							   ('manager'),
							   ('preparateur'),
							   ('envoyeur');


-- MOT DE PASSE EN CLAIR POUR LE MOMENT !!

INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, id_role) VALUES
-- Admins
('Martin', 'Claire', 'claire.martin@fashionchic.fr', 'admin123', 1),
('Dupont', 'Jean', 'jean.dupont@fashionchic.fr', 'admin456', 1),

-- Gérants
('Lemoine', 'Paul', 'paul.lemoine@fashionchic.fr', 'gerant123', 2),
('Girard', 'Julie', 'julie.girard@fashionchic.fr', 'gerant456', 2),

-- Commerciaux
('Moreau', 'Sophie', 'sophie.moreau@fashionchic.fr', 'com123', 3),
('Leroy', 'Nicolas', 'nicolas.leroy@fashionchic.fr', 'com456', 3),

-- Managers
('Blanc', 'Luc', 'luc.blanc@fashionchic.fr', 'manager123', 4),
('Petit', 'Emma', 'emma.petit@fashionchic.fr', 'manager456', 4),

-- Préparateurs
('Roux', 'Alexandre', 'alexandre.roux@fashionchic.fr', 'prep123', 5),
('Fontaine', 'Laura', 'laura.fontaine@fashionchic.fr', 'prep456', 5),

-- Envoyeurs
('Bernard', 'Hugo', 'hugo.bernard@fashionchic.fr', 'env123', 6),
('Gomez', 'Camille', 'camille.gomez@fashionchic.fr', 'env456', 6);

