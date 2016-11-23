-- Se connecter à mysql via l'invite de commande
-- mysql -u username -p

-- Voir les bases de données
SHOW DATABASES;

-- Créer une base de données
CREATE DATABASE DTJ_DB;

-- Se connecter à une base de données
USE nom_db;

-- Voir les tables
SHOW tables;

-- Décrir les tables
DESC nom_table;

/*Créer tables*/
CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(255) NULL,
password VARCHAR(255) NULL,
CONSTRAINT user_pk PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Création d'un user à la mano avec password encodé en sha1*/

CREATE TABLE categorie(
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(255) NULL,
CONSTRAINT categorie_pk PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE contrat(
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(255) NULL,
CONSTRAINT contrat_pk PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE societe(
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(255) NULL,
nom_rh VARCHAR(255) NULL,
infos TEXT NULL,
adresse VARCHAR(255) NULL,
CONSTRAINT societe_pk PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE job(
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(255) NULL,
offre_short TEXT NULL,
offre_long TEXT NULL,
created_at DATETIME NULL,
id_cat INT NOT NULL,
id_societe INT NOT NULL,
id_contrat INT NOT NULL,
CONSTRAINT job_pk PRIMARY KEY (id),
CONSTRAINT job_categorie_fk FOREIGN KEY(id_cat) REFERENCES categorie(id) ON DELETE CASCADE,
CONSTRAINT job_contrat_fk FOREIGN KEY(id_contrat) REFERENCES contrat(id) ON DELETE CASCADE,
CONSTRAINT job_societe_fk FOREIGN KEY(id_societe) REFERENCES societe(id) ON DELETE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE competence(
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(255) NOT NULL,
CONSTRAINT competence_pk PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE competence_job(
id INT NOT NULL AUTO_INCREMENT,
id_j INT NOT NULL,
id_c INT NOT NULL,
CONSTRAINT competence_job_pk PRIMARY KEY(id),
CONSTRAINT competence_job_j_fk FOREIGN KEY(id_j) REFERENCES job(id) ON DELETE CASCADE,
CONSTRAINT competence_job_c_fk FOREIGN KEY(id_c) REFERENCES competence(id) ON DELETE CASCADE)
ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `dtj_db`.`categorie` (`id`, `nom`) VALUES (NULL, 'Design'), (NULL, 'Développement');

INSERT INTO `dtj_db`.`societe` (`id`, `nom`, `nom_rh`, `infos`, `adresse`) VALUES (NULL, 'Next Formation', 'Antonio', 'Centre de formation', '9 avenue de Paris 94300 Vincennes'), (NULL, 'Fnac', 'Max Théret', 'Ex revendeur de disques', 'Clichy La Garenne');

INSERT INTO `dtj_db`.`contrat` (`id`, `nom`) VALUES (NULL, 'CDD'), (NULL, 'CDI');

INSERT INTO `dtj_db`.`job` (`id`, `nom`, `offre_short`, `offre_long`, `created_at`, `id_cat`, `id_societe`, `id_contrat`) VALUES (NULL, 'Formateur PHP.', 'Description courte du job formateur PHP.', 'Description longue du job formateur PHP. Description longue du job formateur PHP. Description longue du job formateur PHP. Description longue du job formateur PHP. Description longue du job formateur PHP. Description longue du job formateur PHP. Description longue du job formateur PHP. ', '2015-04-15 15:30:00', '2', '1', '1'), (NULL, 'Formateur Photoshop.', 'Description courte du job formateur Photoshop. ', 'Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. Description longue du job formateur Photoshop. ', '2015-04-15 15:30:00', '1', '2', '2');

INSERT INTO `dtj_db`.`competence_job` (`id`, `id_j`, `id_c`) VALUES (NULL, '3', '1'), (NULL, '2', '1');

SELECT * FROM job AS JOB, categorie AS CAT, competence AS COMP, competence_job AS COMP_JOB WHERE JOB.id_cat = CAT.id, AND COMP_JOB.id_j = JOB.id, AND COMP_JOB.id_c = COMP.id
