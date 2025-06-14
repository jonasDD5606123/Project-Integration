USE pat_db;

DROP TRIGGER IF EXISTS before_insert_gebruikers;

DROP VIEW IF EXISTS studenten_view;
DROP VIEW IF EXISTS docenten_view;

DROP TABLE IF EXISTS scores;
DROP TABLE IF EXISTS studenten_groepen;
DROP TABLE IF EXISTS studenten_klassen;
DROP TABLE IF EXISTS docenten_vakken;
DROP TABLE IF EXISTS criteria;
DROP TABLE IF EXISTS evaluaties;
DROP TABLE IF EXISTS groepen;
DROP TABLE IF EXISTS gebruikers;
DROP TABLE IF EXISTS klassen;
DROP TABLE IF EXISTS rollen;
DROP TABLE IF EXISTS vakken;

-- CREATE TABLES

CREATE TABLE IF NOT EXISTS vakken (
    id INT PRIMARY KEY AUTO_INCREMENT,
    naam VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS rollen (
    id INT PRIMARY KEY AUTO_INCREMENT,
    naam VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS klassen (
    id INT PRIMARY KEY AUTO_INCREMENT,
    naam VARCHAR(100) NOT NULL,
    vak_id INT NOT NULL,
    CONSTRAINT fk_klassen_vakken FOREIGN KEY (vak_id) REFERENCES vakken(id)
);

CREATE TABLE IF NOT EXISTS gebruikers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    r_nummer VARCHAR(10),
    voornaam VARCHAR(100) NOT NULL,
    achternaam VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol_id INT NOT NULL,
    CONSTRAINT fk_gebruikers_rollen FOREIGN KEY (rol_id) REFERENCES rollen(id)
);

CREATE TABLE IF NOT EXISTS groepen (
    id INT PRIMARY KEY AUTO_INCREMENT,
    naam VARCHAR(100),
    vak_id INT NOT NULL,
    CONSTRAINT fk_groepen_vakken FOREIGN KEY (vak_id) REFERENCES vakken(id)
);

CREATE TABLE IF NOT EXISTS evaluaties (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titel VARCHAR(100),
    beschrijving VARCHAR(100),
    deadline DATETIME NOT NULL,
    vak_id INT NOT NULL,
    CONSTRAINT fk_evaluaties_vakken FOREIGN KEY (vak_id) REFERENCES vakken(id)
);

CREATE TABLE IF NOT EXISTS criteria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    criterium VARCHAR(255) NOT NULL,
    max_waarde DECIMAL(10, 2) NOT NULL,
    min_waarde DECIMAL(10, 2) NOT NULL,
    evaluatie_id INT NOT NULL,
    CONSTRAINT fk_criteria_evaluaties FOREIGN KEY (evaluatie_id) REFERENCES evaluaties(id)
);

CREATE TABLE IF NOT EXISTS docenten_vakken (
    docent_id INT NOT NULL,
    vak_id INT NOT NULL,
    CONSTRAINT fk_docenten_vakken_docent FOREIGN KEY (docent_id) REFERENCES gebruikers(id),
    CONSTRAINT fk_docenten_vakken_vak FOREIGN KEY (vak_id) REFERENCES vakken(id),
    CONSTRAINT pk_docenten_vakken PRIMARY KEY (docent_id, vak_id)
);

CREATE TABLE IF NOT EXISTS studenten_klassen (
    klas_id INT NOT NULL,
    student_id INT NOT NULL,
    CONSTRAINT fk_studenten_klassen_klas FOREIGN KEY (klas_id) REFERENCES klassen(id),
    CONSTRAINT fk_studenten_klassen_student FOREIGN KEY (student_id) REFERENCES gebruikers(id),
    CONSTRAINT pk_studenten_klassen PRIMARY KEY (klas_id, student_id)
);

CREATE TABLE IF NOT EXISTS studenten_groepen (
    student_id INT NOT NULL,
    groep_id INT NOT NULL,
    CONSTRAINT fk_studenten_groepen_student FOREIGN KEY (student_id) REFERENCES gebruikers(id),
    CONSTRAINT fk_studenten_groepen_groep FOREIGN KEY (groep_id) REFERENCES groepen(id),
    CONSTRAINT pk_studenten_groepen PRIMARY KEY (student_id, groep_id)
);

CREATE TABLE IF NOT EXISTS scores (
    criterium_id INT NOT NULL,
    student_id_geevalueerd INT NOT NULL,
    student_id_evalueert INT NOT NULL,
    score DECIMAL(10, 2) NOT NULL,
    feedback VARCHAR(255) NOT NULL,
    gescoord_op DATETIME NOT NULL,
    CONSTRAINT fk_scores_criteria FOREIGN KEY (criterium_id) REFERENCES criteria(id),
    CONSTRAINT fk_scores_studenten_geevalueerd FOREIGN KEY (student_id_geevalueerd) REFERENCES gebruikers(id),
    CONSTRAINT fk_scores_studenten_evalueert FOREIGN KEY (student_id_evalueert) REFERENCES gebruikers(id),
    CONSTRAINT pk_scores PRIMARY KEY (criterium_id, student_id_geevalueerd, student_id_evalueert)
);

-- Insert default roles
INSERT INTO rollen (naam) VALUES ('student'), ('docent');

-- Create views
CREATE VIEW studenten_view AS 
SELECT g.id, g.r_nummer, g.voornaam, g.achternaam, g.email
FROM gebruikers g
WHERE g.rol_id = 1;

CREATE VIEW docenten_view AS
SELECT g.id, g.r_nummer, g.voornaam, g.achternaam, g.email
FROM gebruikers g
WHERE g.rol_id = 2;

-- Create trigger

DELIMITER $$

CREATE TRIGGER before_insert_gebruikers
BEFORE INSERT ON gebruikers
FOR EACH ROW
BEGIN
    IF NEW.rol_id = 1 AND (NEW.r_nummer IS NULL OR NEW.r_nummer = '') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'r_nummer cannot be null or empty when rol_id is 1';
    END IF;
END $$

DELIMITER ;
