/*    Base de données pour le club de parapentes de Lannion
      Devoir de gestion des systemes d'informations

      07/10/2015

      Auteurs :
        Anthony LOHOU
        Tristan LAURENT FRANÇOIS

*/


-- Gestion des clients

CREATE TABLE _client(
  nom VARCHAR(30) NOT NULL,
  prenom VARCHAR(30) NOT NULL,
  naissance DATE NOT NULL,
  adresse VARCHAR(250) NOT NULL,
  telephone VARCHAR(12) NOT NULL,
  poids INTEGER NOT NULL,
  taille INTEGER NOT NULL,
  CONSTRAINT clientPK PRIMARY KEY (nom,prenom,naissance)
);

CREATE TABLE _invite(
  id SERIAL NOT NULL,
  nom VARCHAR(30) NOT NULL,
  prenom VARCHAR(30) NOT NULL,
  naissance DATE NOT NULL,
  CONSTRAINT inviteFK FOREIGN KEY (nom,prenom,naissance) REFERENCES _client,
  CONSTRAINT invitePK PRIMARY KEY (nom,prenom,naissance),
  CONSTRAINT inviteID UNIQUE (id)
);

CREATE TABLE _pilote(
  nom VARCHAR(30) NOT NULL,
  prenom VARCHAR(30) NOT NULL,
  naissance DATE NOT NULL,
  no_licence VARCHAR(30) NOT NULL,
  niveau VARCHAR(20) NOT NULL,
  nbLoc INTEGER NOT NULL,
  achat INTEGER NOT NULL,
  CONSTRAINT piloteFK FOREIGN KEY (nom,prenom,naissance) REFERENCES _client,
  CONSTRAINT pilotePK PRIMARY KEY (nom,prenom,naissance),
  CONSTRAINT piloteUK UNIQUE (no_licence)
);



--Gestion des parapentes

CREATE TABLE _materiel(
  numero INTEGER NOT NULL,
  marque VARCHAR(30) NOT NULL,
  etat VARCHAR(50) NOT NULL,
  CONSTRAINT materielPK PRIMARY KEY (numero)
);

CREATE TABLE _aile(
  numero INTEGER NOT NULL,
  surface INTEGER NOT NULL,
  type VARCHAR(50) NOT NULL,
  poidsMin INTEGER NOT NULL,
  poidsMAX INTEGER NOT NULL,
  CONSTRAINT aileFK FOREIGN KEY (numero) REFERENCES _materiel,
  CONSTRAINT ailePK PRIMARY KEY (numero)
);

CREATE TABLE _suspente(
  numero INTEGER NOT NULL,
  taille INTEGER NOT NULL,
  CONSTRAINT suspenteFK FOREIGN KEY (numero) REFERENCES _materiel,
  CONSTRAINT suspentePK PRIMARY KEY (numero)
);

CREATE TABLE _sellette(
  numero INTEGER NOT NULL,
  type VARCHAR(30) NOT NULL,
  poidsMAX INTEGER NOT NULL,
  CONSTRAINT selletteFK FOREIGN KEY (numero) REFERENCES _materiel,
  CONSTRAINT sellettePK PRIMARY KEY (numero)
);

CREATE TABLE _lieu(
  id SERIAL NOT NULL,
  ville VARCHAR(50) NOT NULL,
  nom VARCHAR(50) NOT NULL,
  lon INTEGER NOT NULL,
  lat INTEGER NOT NULL,
  CONSTRAINT lieuPK PRIMARY KEY (id)
);

CREATE TABLE _location(
  numero SERIAL NOT NULL,
  duree INTEGER NOT NULL,
  depart INTEGER NOT NULL,
  arrivee INTEGER NOT NULL,
  aile INTEGER NOT NULL,
  suspente INTEGER NOT NULL,
  sellette INTEGER NOT NULL,
  pilote VARCHAR(30) NOT NULL,
  dateDeVol DATE NOT NULL,
  invite INTEGER NOT NULL,
  CONSTRAINT volDepart FOREIGN KEY (depart) REFERENCES _lieu,
  CONSTRAINT volArrivee FOREIGN KEY (arrivee) REFERENCES _lieu,
  CONSTRAINT aileParapente FOREIGN KEY (aile) REFERENCES _aile,
  CONSTRAINT piloteCon FOREIGN KEY (pilote) REFERENCES _pilote,
  CONSTRAINT inviteCon FOREIGN KEY (invite) REFERENCES _invite,
  CONSTRAINT selletteParapente FOREIGN KEY (sellette) REFERENCES _sellette,
  CONSTRAINT suspenteParapente FOREIGN KEY (suspente) REFERENCES _suspente,
  CONSTRAINT locationPK PRIMARY KEY (numero)
);


CREATE TABLE _controleTechnique(
  type VARCHAR(30) NOT NULL,
  resultat BOOLEAN NOT NULL,
  date DATE NOT NULL,
  numero INTEGER NOT NULL,
  description VARCHAR(200) NOT NULL,
  numMat INTEGER NOT NULL,
  CONSTRAINT controleTechniqueNumMat FOREIGN KEY (numMat) REFERENCES _materiel,
  CONSTRAINT _controleTechniquePK PRIMARY KEY (numero)
);

CREATE TABLE _fournisseur(
  nom VARCHAR(50) NOT NULL,
  telephone VARCHAR(12) NOT NULL,
  CONSTRAINT fournisseurPK PRIMARY KEY (nom)
);


--Views
