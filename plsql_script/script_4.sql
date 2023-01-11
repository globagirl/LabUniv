--tab6
create table HISTORIQUE_CHERCHEURS (hisno NUMBER, chno number, chnom varchar2(50) , grade varchar2(2) , 
statut char, daterecrut date, salaire number(7,2), prime number(7,2), email varchar2(100), 
supno NUMBER, labno NUMBER, facno NUMBER,
constraint pk_historique_ch primary key (hisno)
);

--Trigger id_tab_historique
create or replace trigger HIS_CHERCHEUR_BIU
 before insert or update on HISTORIQUE_CHERCHEURS
 for each row
begin
 if inserting and :new.hisno is null then
 :new.hisno := to_number(sys_guid(),
 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
 end if;
end;
-- ajout chaque modif de chercheur -> tab historique
CREATE OR REPLACE TRIGGER CHERCHEUR_BUI
BEFORE DELETE OR UPDATE OR INSERT ON CHERCHEUR FOR EACH ROW
BEGIN
	IF DELETING OR UPDATING THEN
		INSERT INTO HISTORIQUE_CHERCHEURS (chno, chnom, grade, statut, daterecrut, salaire, prime, email, supno, labno, facno, hisdate) 
		VALUES(:OLD.chno, :OLD.chnom, :OLD.grade, :OLD.statut, :OLD.daterecrut, 
		:OLD.salaire, :OLD.prime, :OLD.email, :OLD.supno, :OLD.labno, :OLD.facno,SYSDATE);
	END IF;

	IF INSERTING OR UPDATING THEN NULL; 
	
	END IF;
END;

--control de nbr d'encdrm par chaque directeur --------------------------------------
CREATE OR REPLACE TRIGGER encadrement_control 
BEFORE INSERT OR UPDATE ON CHERCHEUR FOR EACH ROW
DECLARE
 	NE integer;
	ND integer;
	gr varchar(2);
BEGIN
	gr := :NEW.grade;
IF :OLD.supno IS NOT NULL THEN 
	SELECT COUNT(*)  INTO NE FROM CHERCHEUR WHERE supno = :NEW.supno AND grade = 'E';
	SELECT COUNT(*)  INTO ND FROM CHERCHEUR WHERE supno = :NEW.supno AND  grade = 'D';

	IF NE>30 THEN 
		RAISE_APPLICATION_ERROR(-20001,'Impossible d encadrer plus que 30 etudiants!'); 
	END IF;

	IF ND>20 THEN 
		RAISE_APPLICATION_ERROR(-20002,'Impossible d encadrer plus que 20 doctorants!'); 
	END IF;
END IF;

END;

-- innterdire la diminution salaire--------------------------------------------
CREATE OR REPLACE TRIGGER chercheur_sal
BEFORE INSERT OR UPDATE ON CHERCHEUR
FOR EACH ROW 
BEGIN 
	IF updating THEN 
	IF :OLD.salaire > :NEW.salaire THEN 
		RAISE_APPLICATION_ERROR(-20004,'Impossible de diminué le salaire !'); 
	END IF;
END IF;
END;
--test proc chercheur_sal
update CHERCHEUR set salaire=500 where chnom = 'Ahmed'; 


--limiter la mise à jour db que durant les jr ouverable ou heure de travail

CREATE OR REPLACE TRIGGER permit_changes_histo
  BEFORE INSERT OR DELETE OR UPDATE ON HISTORIQUE_CHERCHEURS
FOR EACH ROW 
DECLARE
  Not_on_weekends   EXCEPTION;
  Nonworking_hours  EXCEPTION;
  PRAGMA EXCEPTION_INIT (Not_on_weekends, -20324);
  PRAGMA EXCEPTION_INIT (Nonworking_hours, -20326);
BEGIN 
	-- Check for weekends:
   IF (TO_CHAR(Sysdate, 'DAY') = 'SAT' OR
     TO_CHAR(Sysdate, 'DAY') = 'SUN') THEN
       RAISE Not_on_weekends;
   END IF;
  
  -- Check for work hours (8am to 6pm):
  IF (TO_CHAR(Sysdate, 'HH24') < 8 OR
    TO_CHAR(Sysdate, 'HH24') > 18) THEN
      RAISE Nonworking_hours;
  END IF;
 
  EXCEPTION
  WHEN Not_on_weekends THEN
    Raise_application_error(-20324,'ILLEGAL OPERATION - WEEKEND OR HOLIDAY!');
  WHEN Nonworking_hours THEN
    Raise_application_error(-20326,'ILLEGAL OPERATION - OUT OF OFFICE HOURS !');
END;

