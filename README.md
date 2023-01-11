# LabUniv

##outils:--------------------------------------------------------
  -oracle database
  -docker
  
#pull oracle images----------------------------------------------
//pull
> docker pull gvenzl/oracle-xe
//run container
> docker run -d -p 1521:1521 -e ORACLE_PASSWORD=amo gvenzl/oracle-xe
	d94eebab6e97 <- is the container id
> docker exec d94eebab6e97 resetPassword amo
> docker exec -it d94eebab6e97 bash
    > sqlplus system as sysdba
      -pass= oracle
        > alter session set "_oracle_script"=TRUE;
        > drop user amo cascade;
        > create user amo identified by "amo";
        > GRANT CONNECT, RESOURCE, DBA TO amo;
