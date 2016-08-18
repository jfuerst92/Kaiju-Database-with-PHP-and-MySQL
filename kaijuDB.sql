-- Author: Joseph Fuerst

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `gz_kaiju`;
DROP TABLE IF EXISTS `gz_movies`;
DROP TABLE IF EXISTS `gz_aliases`;
DROP TABLE IF EXISTS `gz_powers`;
DROP TABLE IF EXISTS `gz_kaiju_enemies`;
DROP TABLE IF EXISTS `gz_kaiju_aliases`;
DROP TABLE IF EXISTS `gz_kaiju_powers`;
DROP TABLE IF EXISTS `gz_kaiju_in_movies`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE gz_kaiju (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  height_in_meters INT,
  weight_in_tons INT,
  UNIQUE (name),
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE gz_movies (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  year_released INT,
  length_in_minutes INT,
  UNIQUE (name),
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE gz_kaiju_in_movies (
  kid INT UNSIGNED NOT NULL,
  movid INT UNSIGNED NOT NULL,
  PRIMARY KEY (kid, movid),
  CONSTRAINT `gz_km` FOREIGN KEY (kid) REFERENCES gz_kaiju (id),
  CONSTRAINT `gz_mk` FOREIGN KEY (movid) REFERENCES gz_movies (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE gz_powers (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  type_of_power VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE gz_kaiju_powers (
  kid INT UNSIGNED NOT NULL,
  pid INT UNSIGNED NOT NULL,
  CONSTRAINT `gz_kp` FOREIGN KEY (kid) REFERENCES gz_kaiju (id),
  CONSTRAINT `gz_kp2` FOREIGN KEY (pid) REFERENCES gz_powers (id),
  PRIMARY KEY (kid, pid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE gz_aliases (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE gz_kaiju_aliases (
  kid INT UNSIGNED NOT NULL,
  aid INT UNSIGNED NOT NULL,
  CONSTRAINT `gz_ka` FOREIGN KEY (kid) REFERENCES gz_kaiju (id),
  CONSTRAINT `gz_ak` FOREIGN KEY (aid) REFERENCES gz_aliases (id) ON DELETE CASCADE,
  PRIMARY KEY (kid, aid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE gz_kaiju_enemies (
  kid INT UNSIGNED NOT NULL,
  eid INT UNSIGNED NOT NULL,
  CONSTRAINT `gz_pkaiju` FOREIGN KEY (kid) REFERENCES gz_kaiju (id),
  CONSTRAINT `gz_ekaiju` FOREIGN KEY (eid) REFERENCES gz_kaiju (id),
  PRIMARY KEY (kid, eid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO gz_kaiju (name, height_in_meters, weight_in_tons)
VALUES ('Godzilla','100','20000'); 

INSERT INTO gz_kaiju (name, height_in_meters, weight_in_tons)
VALUES ('Mothra','65','15000'); 

INSERT INTO gz_kaiju (name, height_in_meters, weight_in_tons)
VALUES ('King Ghidorah','100','30000'); 

INSERT INTO gz_movies (name, year_released, length_in_minutes)
VALUES ('Godzilla','1954','96'); 

INSERT INTO gz_movies (name, year_released, length_in_minutes)
VALUES ('Mothra vs. Godzilla ','1964', '88'); 

INSERT INTO gz_movies (name, year_released, length_in_minutes)
VALUES ('Ghidorah, the Three-Headed Monster','1964','93'); 

INSERT INTO gz_kaiju_in_movies (kid, movid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_movies WHERE name = 'Godzilla')); 

INSERT INTO gz_kaiju_in_movies (kid, movid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_movies WHERE name = 'Mothra vs. Godzilla')); 

INSERT INTO gz_kaiju_in_movies (kid, movid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_movies WHERE name = 'Ghidorah, the Three-Headed Monster')); 

INSERT INTO gz_kaiju_in_movies (kid, movid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Mothra'),(SELECT id FROM gz_movies WHERE name = 'Mothra vs. Godzilla')); 

INSERT INTO gz_kaiju_in_movies (kid, movid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_movies WHERE name = 'Ghidorah, the Three-Headed Monster')); 



INSERT INTO gz_powers (type_of_power)
VALUES ('flight'); 

INSERT INTO gz_powers (type_of_power)
VALUES ('atomic breath'); 

INSERT INTO gz_powers (type_of_power)
VALUES ('regeneration'); 

INSERT INTO gz_powers (type_of_power)
VALUES ('teleportation'); 

INSERT INTO gz_powers (type_of_power)
VALUES ('energy absorption'); 

INSERT INTO gz_powers (type_of_power)
VALUES ('evolution'); 



INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_powers WHERE type_of_power = 'flight')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_powers WHERE type_of_power = 'atomic breath')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_powers WHERE type_of_power = 'atomic breath')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_powers WHERE type_of_power = 'regeneration')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_powers WHERE type_of_power = 'teleportation')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_powers WHERE type_of_power = 'energy absorption')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Mothra'),(SELECT id FROM gz_powers WHERE type_of_power = 'flight')); 

INSERT INTO gz_kaiju_powers (kid, pid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Mothra'),(SELECT id FROM gz_powers WHERE type_of_power = 'evolution')); 



INSERT INTO gz_aliases (name)
VALUES ('King Of The Monsters'); 

INSERT INTO gz_aliases (name)
VALUES ('The Thing'); 

INSERT INTO gz_aliases (name)
VALUES ('Monster Zero'); 




INSERT INTO gz_kaiju_aliases (kid, aid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_aliases WHERE name = 'King Of The Monsters')); 

INSERT INTO gz_kaiju_aliases (kid, aid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Mothra'),(SELECT id FROM gz_aliases WHERE name = 'The Thing')); 

INSERT INTO gz_kaiju_aliases (kid, aid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_aliases WHERE name = 'Monster Zero')); 



INSERT INTO gz_kaiju_enemies (kid, eid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah')); 

INSERT INTO gz_kaiju_enemies (kid, eid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'King Ghidorah'),(SELECT id FROM gz_kaiju WHERE name = 'Godzilla')); 

INSERT INTO gz_kaiju_enemies (kid, eid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Godzilla'),(SELECT id FROM gz_kaiju WHERE name = 'Mothra')); 

INSERT INTO gz_kaiju_enemies (kid, eid)
VALUES ((SELECT id FROM gz_kaiju WHERE name = 'Mothra'),(SELECT id FROM gz_kaiju WHERE name = 'Godzilla')); 


