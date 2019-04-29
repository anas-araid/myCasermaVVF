DROP DATABASE IF EXISTS my_casermaVVF;
CREATE DATABASE IF NOT EXISTS my_casermaVVF DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
USE my_casermaVVF;

CREATE TABLE t_gradi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Grado            VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;


CREATE TABLE t_caserme (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione      VARCHAR(50) UNIQUE,
  Telefono         VARCHAR(50),
  Email            VARCHAR(50),
  Password         VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_vigili (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  Matricola		     VARCHAR(5),
  Cellulare		     VARCHAR(20)	UNIQUE,
  Chat_ID 		     VARCHAR(20)	UNIQUE,
  Reperibile       BOOLEAN,
  FK_Grado 			   BIGINT,
  FK_CorpoVVF		   BIGINT,
  Autista          BOOLEAN,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Grado)    REFERENCES t_gradi(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_CorpoVVF)    REFERENCES t_caserme(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_mezzi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione      VARCHAR(50),
  FK_CorpoVVF      BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_CorpoVVF)    REFERENCES t_caserme(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_attrezzature (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome             VARCHAR(50),
  Quantita         VARCHAR(50),
  FK_CorpoVVF      BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_CorpoVVF)    REFERENCES t_caserme(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_certificazioni (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Corso            VARCHAR(200),
  File             VARCHAR(200),
  FK_Vigile        BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Vigile)    REFERENCES t_vigili(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_numeroSquadre (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Numero           VARCHAR(50),
  FK_CorpoVVF      BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_CorpoVVF)    REFERENCES t_caserme(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE UNIQUE INDEX squadraUnica ON t_numeroSquadre (Numero, FK_CorpoVVF);

CREATE TABLE t_squadre (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_NumeroSquadra BIGINT,
  FK_Vigile        BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_NumeroSquadra)    REFERENCES t_numeroSquadre(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_Vigile)    REFERENCES t_vigili(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_turniFestivi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  dataTurno        DATE,
  FK_NumeroSquadra BIGINT,
  FK_Checklist     BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_NumeroSquadra)    REFERENCES t_numeroSquadre(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_Checklist)    REFERENCES t_mezzi(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;


INSERT INTO t_gradi (Grado) VALUES ('Ispettore'); /* 1 */
INSERT INTO t_gradi (Grado) VALUES ('Vice ispettore'); /* 2 */
INSERT INTO t_gradi (Grado) VALUES ('Comandante'); /* 3 */
INSERT INTO t_gradi (Grado) VALUES ('Vice comandante'); /* 4 */
INSERT INTO t_gradi (Grado) VALUES ('Capo plotone'); /* 5 */
INSERT INTO t_gradi (Grado) VALUES ('Capo squadra'); /* 6 */
INSERT INTO t_gradi (Grado) VALUES ('Vigile'); /* 7 */
