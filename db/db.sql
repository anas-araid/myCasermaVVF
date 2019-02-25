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
  Matricola		     VARCHAR(5)	UNIQUE NOT NULL,
  Cellulare		     VARCHAR(20)	UNIQUE,
  Chat_ID 		     VARCHAR(20)	UNIQUE,
  FK_Grado 			   BIGINT,
  FK_CorpoVVF		   BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Grado)    REFERENCES t_gradi(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_CorpoVVF)    REFERENCES t_caserme(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
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
  Numero           VARCHAR(50) UNIQUE,
  FK_CorpoVVF      BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_CorpoVVF)    REFERENCES t_caserme(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_squadre (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_NumeroSquadra BIGINT,
  FK_Vigile        BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_NumeroSquadra)    REFERENCES t_numeroSquadre(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Vigile)    REFERENCES t_vigili(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE t_turniFestivi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  dataTurno        DATE,
  FK_NumeroSquadra BIGINT,
  FK_Checklist     BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_NumeroSquadra)    REFERENCES t_numeroSquadre(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Checklist)    REFERENCES t_mezzi(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

INSERT INTO t_caserme (Descrizione, Telefono, Password) VALUES ('Pergine Valsugana','0461531054', '5f4dcc3b5aa765d61d8327deb882cf99');

INSERT INTO t_gradi (Grado) VALUES ('Ispettore'); /* 1 */
INSERT INTO t_gradi (Grado) VALUES ('Vice ispettore'); /* 2 */
INSERT INTO t_gradi (Grado) VALUES ('Comandante'); /* 3 */
INSERT INTO t_gradi (Grado) VALUES ('Vice comandante'); /* 4 */
INSERT INTO t_gradi (Grado) VALUES ('Capo plotone'); /* 5 */
INSERT INTO t_gradi (Grado) VALUES ('Capo squadra'); /* 6 */
INSERT INTO t_gradi (Grado) VALUES ('Vigile'); /* 7 */


INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('1', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('2', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('3', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('4', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('5', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('6', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('7', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('8', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('9', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('10', 1);
INSERT INTO t_numeroSquadre (Numero, FK_CorpoVVF) VALUES ('11', 1);

INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('VW Interventi Tecnici', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('VW Pinze', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Daily Interventi Tecnici', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Autobotte Volvo', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Autobotte 180', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Minibotte', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Autoscala', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Snorkel', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Autogru MAN', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Nissan Terrano', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Land Rover TD5', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Land Rover TD4', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Mitsubishi Pickup', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Gommone', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Fiat Punto', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Daily Trasporto', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('VW trasp. persone', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('VW trasp. unione', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Carrello trasporto mezzi', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Pompa Ziegler', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Carrello Ziegler', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Carrello incendi boschivi', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Pompa Rosenbauer', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Carrello gruppo elettrogeno', 1);
INSERT INTO t_mezzi (Descrizione, FK_CorpoVVF) VALUES ('Idrovora', 1);
