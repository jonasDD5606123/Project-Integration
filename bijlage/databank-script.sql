drop database if exists ID439999_PeerAssessmentT;
drop database if exists pat_db;

create database if not exists pat_db;

use pat_db;

create table if not exists vakken (
    id int primary key auto_increment,
    naam varchar(100) not null
);

create table if not exists rollen (
    id int primary key auto_increment,
    naam varchar(100) not null
);

create table if not exists klassen (
    id int primary key auto_increment,
    naam varchar(100) not null,
    vak_id int not null,
    constraint fk_klassen_vakken foreign key (vak_id) references vakken(id)
);

create table if not exists gebruikers (
    id int primary key auto_increment,
    r_nummer varchar(10),
    voornaam varchar(100) not null,
    achternaam varchar(100) not null,
    email varchar(255) unique not null,
    password varchar(255) not null,
    rol_id int not null,
    constraint fk_gebruikers_rollen foreign key (rol_id) references rollen(id)
);

create table if not exists groepen (
    id int primary key auto_increment,
    naam varchar(100),
    vak_id int not null,
    constraint fk_groepen_vakken foreign key (vak_id) references vakken(id)
);

create table if not exists evaluaties (
    id int primary key auto_increment,
    titel varchar(100),
    beschrijving varchar(100),
    deadline datetime not null,
    vak_id int not null,
    constraint fk_evaluaties_vakken foreign key (vak_id) references vakken(id)
);

create table if not exists criteria (
    id int primary key auto_increment,
    criterium varchar(255) not null,
    max_waarde decimal(10, 2) not null,
    min_waarde decimal(10, 2) not null,
    evaluatie_id int not null,
    constraint fk_criteria_evaluaties foreign key (evaluatie_id) references evaluaties(id)
);

create table if not exists docenten_vakken (
    docent_id int not null,
    vak_id int not null,
    constraint fk_docenten_vakken_docent foreign key (docent_id) references gebruikers(id),
    constraint fk_docenten_vakken_vak foreign key (vak_id) references vakken(id),
    constraint pk_docenten_vakken primary key (docent_id, vak_id)
);

create table if not exists studenten_klassen (
    klas_id int not null,
    student_id int not null,
    constraint fk_studenten_klassen_klas foreign key (klas_id) references klassen(id),
    constraint fk_studenten_klassen_student foreign key (student_id) references gebruikers(id),
    constraint pk_studenten_klassen primary key (klas_id, student_id)
);

create table if not exists studenten_groepen (
    student_id int not null,
    groep_id int not null,
    constraint fk_studenten_groepen_student foreign key (student_id) references gebruikers(id),
    constraint fk_studenten_groepen_groep foreign key (groep_id) references groepen(id),
    constraint pk_studenten_groepen primary key (student_id, groep_id)
);

create table if not exists scores (
    criterium_id int not null,
    student_id_geevalueerd int not null,
    student_id_evalueert int not null,
    score decimal(10, 2) not null,
    feedback varchar(255) not null,
    gescoord_op datetime not null,
    constraint fk_scores_criteria foreign key (criterium_id) references criteria(id),
    constraint fk_scores_studenten_geevalueerd foreign key (student_id_geevalueerd) references gebruikers(id),
    constraint fk_scores_studenten_evalueert foreign key (student_id_evalueert) references gebruikers(id),
    constraint pk_scores primary key (criterium_id, student_id_geevalueerd, student_id_evalueert)
);

/*
rol_id 1 = student
rol_id 2 = docent
*/

insert into rollen (naam) values ('student'), ('docent');

create view studenten_view as 
    select g.id, g.r_nummer, g.voornaam, g.achternaam, g.email
    from gebruikers g  join rollen r on g.rol_id = r.id where g.rol_id = 1;

create view docenten_view as
    select g.id, g.r_nummer, g.voornaam, g.achternaam, g.email
    from gebruikers g join rollen r on g.rol_id = r.id where g.rol_id = 2;