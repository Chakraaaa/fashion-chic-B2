CREATE TABLE ROLE (
					  id_role INT AUTO_INCREMENT PRIMARY KEY,
					  libelle VARCHAR(255) NOT NULL
);

CREATE TABLE UTILISATEUR (
							 id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
							 nom VARCHAR(255) NOT NULL,
							 prenom VARCHAR(255) NOT NULL,
							 email VARCHAR(255) NOT NULL UNIQUE,
							 mot_de_passe VARCHAR(255) NOT NULL,
							 id_role INT NOT NULL,
							 FOREIGN KEY (id_role) REFERENCES ROLE(id_role)
);

CREATE TABLE CLIENT (
						id_client INT AUTO_INCREMENT PRIMARY KEY,
						nom VARCHAR(255) NOT NULL,
						adresse VARCHAR(255),
						telephone VARCHAR(20),
						email VARCHAR(255),
						id_commercial INT,
						FOREIGN KEY (id_commercial) REFERENCES UTILISATEUR(id_utilisateur)
);

CREATE TABLE produit (
						 id_produit INT AUTO_INCREMENT PRIMARY KEY,
						 reference VARCHAR(100) NOT NULL UNIQUE,        -- SKU ou code article
						 nom VARCHAR(255) NOT NULL,
						 description TEXT,
						 categorie VARCHAR(100),                        -- Ex: T-Shirt, Jean...
						 genre ENUM('Homme', 'Femme', 'Enfant', 'Mixte'),
						 taille VARCHAR(20),
						 couleur VARCHAR(50),
						 saison VARCHAR(20),                            -
						 marque VARCHAR(100),
						 prix_achat DECIMAL(10,2),
						 prix_vente DECIMAL(10,2),
						 quantite INT DEFAULT 0,
						 seuil_reappro INT DEFAULT 0,
						 ean VARCHAR(50),                               -- Code barre si dispo
						 actif BOOLEAN DEFAULT TRUE,
						 date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
						 date_modif DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE LOT (
					 id_lot INT AUTO_INCREMENT PRIMARY KEY,
					 date_creation DATE NOT NULL,
);

CREATE TABLE CONTENU_LOT (
							 id_lot INT NOT NULL,
							 id_produit INT NOT NULL,
							 quantite INT NOT NULL,
							 PRIMARY KEY (id_lot, id_produit),
							 FOREIGN KEY (id_lot) REFERENCES LOT(id_lot),
							 FOREIGN KEY (id_produit) REFERENCES PRODUIT(id_produit)
);

CREATE TABLE COMMANDE (
						  id_commande INT AUTO_INCREMENT PRIMARY KEY,
						  numero_commande VARCHAR(50) NOT NULL UNIQUE,
						  id_client INT NOT NULL,
						  id_commercial INT,
						  date_commande DATE NOT NULL,
						  cout_total DECIMAL(10,2) NOT NULL DEFAULT 0.00,
						  statut VARCHAR(100),
						  FOREIGN KEY (id_client) REFERENCES CLIENT(id_client),
						  FOREIGN KEY (id_commercial) REFERENCES UTILISATEUR(id_utilisateur)
);

CREATE TABLE COMMANDE_LOT (
							  id_commande INT NOT NULL,
							  id_lot INT NOT NULL,
							  quantite INT NOT NULL DEFAULT 1,
							  PRIMARY KEY (id_commande, id_lot),
							  FOREIGN KEY (id_commande) REFERENCES COMMANDE(id_commande) ON DELETE CASCADE,
							  FOREIGN KEY (id_lot) REFERENCES LOT(id_lot)
);



CREATE TABLE PREPARATION (
							 id_preparation INT AUTO_INCREMENT PRIMARY KEY,
							 id_commande INT NOT NULL,
							 id_preparateur INT,
							 date_preparation DATE,
							 statut VARCHAR(100),
							 FOREIGN KEY (id_commande) REFERENCES COMMANDE(id_commande),
							 FOREIGN KEY (id_preparateur) REFERENCES UTILISATEUR(id_utilisateur)
);
