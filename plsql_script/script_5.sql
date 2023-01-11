-- PROCEDURE & FONCTION --------------------

--procedure insertion chercheur 
CREATE OR REPLACE PROCEDURE AJOUT_CHERCHEUR(
	p_chnom IN CHERCHEUR.chnom%TYPE , 
	p_grade IN CHERCHEUR.grade%TYPE, 
	p_statut IN CHERCHEUR.statut%TYPE, 
	p_daterecrut IN CHERCHEUR.daterecrut%TYPE, 
	p_salaire IN CHERCHEUR.salaire%TYPE, 
	p_prime IN CHERCHEUR.prime%TYPE, 
	p_email IN CHERCHEUR.email%TYPE, 
	p_supno IN CHERCHEUR.chnom%TYPE, 
	p_labno IN LABORATOIRE.LABNOM%TYPE, 
	p_facno IN FACULTE.facnom%TYPE
	)
IS
BEGIN

INSERT INTO CHERCHEUR 
(chnom, grade, statut, daterecrut, salaire, prime, email, supno, labno, facno)VALUES (
	p_chnom, p_grade, p_statut, p_daterecrut, p_salaire, p_prime, p_email, 
	(SELECT chno FROM CHERCHEUR WHERE CHNOM=p_supno), 
	(SELECT labno FROM LABORATOIRE WHERE labnom=p_labno),
	(SELECT facno FROM FACULTE WHERE facnom=p_facno));
Commit;
DBMS_OUTPUT.PUT_LINE('Chercheur '||p_chnom||' ajouté ');
END;
--test procedure insertion chercheur 
BEGIN
   AJOUT_CHERCHEUR('anis','D','C',TO_DATE('22/08/2022', 'DD/MM/YYYY'),'600','150','anis24@gmail.com',
	'Ahmed','RedHat','UIT');
END;

--procedure modification chercheur -----------------------------
CREATE OR REPLACE PROCEDURE MODIF_CHERCHEUR(
	p_chnom IN CHERCHEUR.chnom%TYPE , 
	p_grade IN CHERCHEUR.grade%TYPE, 
	p_statut IN CHERCHEUR.statut%TYPE, 
	p_daterecrut IN CHERCHEUR.daterecrut%TYPE, 
	p_salaire IN CHERCHEUR.salaire%TYPE, 
	p_prime IN CHERCHEUR.prime%TYPE, 
	p_email IN CHERCHEUR.email%TYPE, 
	p_supno IN CHERCHEUR.chnom%TYPE, 
	p_labno IN LABORATOIRE.LABNOM%TYPE, 
	p_facno IN FACULTE.facnom%TYPE
	)
IS
BEGIN

UPDATE CHERCHEUR SET chnom=p_chnom, grade=p_grade, statut=p_statut, daterecrut=p_daterecrut, 
salaire=p_salaire, prime=p_prime, email=p_email, supno=(SELECT chno FROM CHERCHEUR WHERE CHNOM=p_supno),
labno=(SELECT labno FROM LABORATOIRE WHERE labnom=p_labno), facno=(SELECT facno FROM FACULTE WHERE facnom=p_facno)
WHERE chnom=p_chnom;

Commit;
DBMS_OUTPUT.PUT_LINE('Chercheur '||p_chnom||' à jours ');
END;
--test procedure modification chercheur 
BEGIN
   MODIF_CHERCHEUR('Anis','D','C',TO_DATE('22/08/2022', 'DD/MM/YYYY'),'500','150','anis24@gmail.com',
	'Ahmed','RedHat','UIT');
END;


--fonction
/*
CREATE OR REPLACE FUNCTION liste_chercheur_maxPub(date_deb IN DATE, date_fin IN DATE )
RETURN 
sys_refcursor
as  
  l_ch sys_refcursor;
BEGIN
	open l_ch for
		SELECT * FROM CHERCHEUR JOIN FACULTE USING (facno)join(select * from publication join publier using (pubno)) using (chno);
    return l_ch;
END;*/

--procedure suppression chercheur 
CREATE OR REPLACE PROCEDURE DELETEchercheur (   
p_name IN CHERCHEUR.CHNOM%TYPE)  
IS  
BEGIN  
DELETE FROM CHERCHEUR WHERE CHNOM=p_name;  
DBMS_OUTPUT.PUT_LINE('Chercheur '||p_name||' supprimé ');

END;  
--test procedure suppression chercheur 
BEGIN
   DELETEchercheur('Taysir');
END;
