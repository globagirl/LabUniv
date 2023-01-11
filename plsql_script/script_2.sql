-- DATA INSERTION ------------------------------

-- remplissage faculte -----------------------------
INSERT INTO FACULTE (facnom, adresse, libelle) VALUES ('UIT','charguia 1, tunis','université internationnal tunis');
INSERT INTO FACULTE (facnom, adresse, libelle) VALUES ('ITEAM','cite belvedere, tunis','iteam');
INSERT INTO FACULTE (facnom, adresse, libelle) VALUES ('esprit','ghazela, tunis','esprit');

-- remplissage laboratoire -------------------------
INSERT INTO LABORATOIRE (labnom,facno) VALUES ('RedHat',(SELECT facno FROM FACULTE WHERE facnom='UIT'));
INSERT INTO LABORATOIRE (labnom,facno) VALUES ('robotique',(SELECT facno FROM FACULTE WHERE facnom='esprit'));

);
-- remplissage CHERCHEUR ------------------------------------------
INSERT INTO CHERCHEUR (chnom, grade, statut, daterecrut, salaire, prime, email, supno, labno, facno) 
VALUES (
	'Aymen','E','C',TO_DATE('20/12/2022', 'DD/MM/YYYY'),'900','200','aymen@gmail.com',
	(SELECT chno FROM CHERCHEUR WHERE CHNOM='Ahmed'),
	(SELECT labno FROM LABORATOIRE WHERE labnom='RedHat'),
	(SELECT facno FROM FACULTE WHERE facnom='UIT')
);

INSERT INTO CHERCHEUR (chnom, grade, statut, daterecrut, salaire, prime, email, supno, labno, facno) 
VALUES (
	'Taysir','E','C',TO_DATE('01/08/2022', 'DD/MM/YYYY'),'900','200','taysir@gmail.com',
	(SELECT chno FROM CHERCHEUR WHERE CHNOM='Ahmed'),
	(SELECT labno FROM LABORATOIRE WHERE labnom='RedHat'),
	(SELECT facno FROM FACULTE WHERE facnom='UIT')
);

INSERT INTO CHERCHEUR (chnom, grade, statut, daterecrut, salaire, prime, email, supno, labno, facno) 
VALUES (
	'Ahmed','D','P',TO_DATE('17/08/2020', 'DD/MM/YYYY'),'1800','1000','ahmed@gmail.com',
	null,
	(SELECT labno FROM LABORATOIRE WHERE labnom='RedHat'),
	(SELECT facno FROM FACULTE WHERE facnom='UIT')
);
INSERT INTO CHERCHEUR (chnom, grade, statut, daterecrut, salaire, prime, email, supno, labno, facno) 
VALUES (
	'Amal','D','P',TO_DATE('17/08/2020', 'DD/MM/YYYY'),'1800','1000','amal@gmail.com',
	null,
	(SELECT labno FROM LABORATOIRE WHERE labnom='robotique'),
	(SELECT facno FROM FACULTE WHERE facnom='esprit')
);

-- remplissage publication ----------------------------------------
INSERT INTO PUBLICATION (titre, theme, TYPEPUB , volume, DATEPUB , apparition, editeur) VALUES (
	'Selecting a New Key Derivation Function for Disk Encryption','Informatique','AS','5',
	TO_DATE('20/02/2021', 'DD/MM/YYYY'),'RedHat research blog','Milan'
);
INSERT INTO PUBLICATION (titre, theme, TYPEPUB , volume, DATEPUB , apparition, editeur) VALUES (
	'Datastructure','Informatique','AS','5',
	TO_DATE('20/02/2021', 'DD/MM/YYYY'),'research blog','Milan'
);
INSERT INTO PUBLICATION (titre, theme, TYPEPUB , volume, DATEPUB , apparition, editeur) VALUES (
	'developpement','Informatique','AS','5',
	TO_DATE('20/02/2021', 'DD/MM/YYYY'),'dev research blog','Milan'


-- remplissage publier --------------------------------------
INSERT INTO PUBLIER (chno, pubno, rang) VALUES  (
(SELECT chno FROM CHERCHEUR WHERE CHNOM='aymen'),
(SELECT PUBNO FROM PUBLICATION WHERE titre='Selecting a New Key Derivation Function for Disk Encryption'),
2
);
INSERT INTO PUBLIER (chno, pubno, rang) VALUES  (
(SELECT chno FROM CHERCHEUR WHERE CHNOM='Amal'),
(SELECT PUBNO FROM PUBLICATION WHERE titre='Datastructure'),
1
);
INSERT INTO PUBLIER (chno, pubno, rang) VALUES  (
(SELECT chno FROM CHERCHEUR WHERE CHNOM='Amal'),
(SELECT PUBNO FROM PUBLICATION WHERE titre='developpement'),
1
);

