------TABLE CREATION ------------------

--tab1
create table FACULTE(
facno number, facnom varchar2(50), adresse varchar2(100), 
libelle varchar2(50),
constraint pk_faculte primary key (facno)
);
--tab2
create table LABORATOIRE(
labno number, labnom varchar2(50), facno NUMBER,
constraint pk_laboratoire primary key (labno),
CONSTRAINT fk_laboratoire_faculte FOREIGN KEY (facno) 
REFERENCES FACULTE (facno)
);
--tab3
create table CHERCHEUR (chno number, chnom varchar2(50) , 
grade varchar2(2) , 
statut char, daterecrut date, salaire number(7,2), prime number(7,2),
 email varchar2(100), 
constraint pk_chercheur primary key (chno),supno NUMBER, labno NUMBER,
 facno NUMBER,
constraint fk_chercheur_chercheur foreign key(supno) 
references CHERCHEUR (chno) , 
constraint fk_chercheur_laboratoire foreign key(labno) 
references LABORATOIRE (labno),
constraint fk_chercheur_faculte foreign key(facno) 
references FACULTE (facno)
);
--tab4
CREATE TABLE PUBLICATION ( pubno varchar2(50), 
titre varchar2(100), theme varchar2(50), typepub varchar2(5),
volume number, datepub DATE , apparition varchar2(50),
editeur varchar2(50),
constraint pk_publication primary key (pubno)
);
--tab5
CREATE TABLE PUBLIER (
chno NUMBER, pubno varchar2(50), rang NUMBER,
constraint fk_publier_chercheur foreign key(chno) references 
CHERCHEUR (chno) , 
constraint fk_publier_publication foreign key(pubno) references 
PUBLICATION (pubno)
);

-- TRIGGERS & SEQUENCE -------------------------------

--Trigger id_tab_faculte
create or replace trigger FACULTE_BIU
 before insert or update on FACULTE
 for each row
begin
 if inserting and :new.facno is null then
 :new.facno := to_number(sys_guid(),
 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
 end if;
end;

--Trigger id_tab_laboratoire
create or replace trigger LABORATOIRE_BIU
 before insert or update on LABORATOIRE
 for each row
begin
 if inserting and :new.labno is null then
 :new.labno := to_number(sys_guid(),
 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
 end if;
end;

--Trigger id_tab_chercheur
create or replace trigger CHERCHEUR_BIU
 before insert or update on CHERCHEUR
 for each row
begin
 if inserting and :new.chno is null then
 :new.chno := to_number(sys_guid(),
 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');
 end if;
end;


--Sequence id_tab_publication----------------------------------------------

CREATE SEQUENCE publication_seq
  MINVALUE 1000
  MAXVALUE 9999
  START WITH 1000
  INCREMENT BY 1
  CACHE 20;
  
--Trigger id_tab_pulication

CREATE OR REPLACE TRIGGER pubno_trigger BEFORE INSERT OR 
UPDATE ON PUBLICATION
FOR EACH ROW 
BEGIN 
	IF INSERTING and :NEW.pubno IS NULL THEN
		:NEW.pubno := TO_CHAR(:new.datepub,'YY')||'-'|| 
		TO_CHAR(publication_seq.NEXTVAL);
	END IF;
END;
--------------------------------------------------------------------------






