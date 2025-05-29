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

CREATE TABLE PRODUIT (
						 id_produit INT AUTO_INCREMENT PRIMARY KEY,
						 nom VARCHAR(255) NOT NULL,
						 categorie VARCHAR(255),
						 taille VARCHAR(50),
						 couleur VARCHAR(50),
						 marque VARCHAR(100)
);

CREATE TABLE LOT (
					 id_lot INT AUTO_INCREMENT PRIMARY KEY,
					 date_creation DATE NOT NULL,
					 statut VARCHAR(100)
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
						  id_client INT NOT NULL,
						  id_commercial INT,
						  id_lot INT,
						  date_commande DATE NOT NULL,
						  statut VARCHAR(100),
						  FOREIGN KEY (id_client) REFERENCES CLIENT(id_client),
						  FOREIGN KEY (id_commercial) REFERENCES UTILISATEUR(id_utilisateur),
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
