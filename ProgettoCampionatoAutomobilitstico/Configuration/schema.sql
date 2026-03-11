create table case_automobilistiche(
Id_casa int primary key auto_increment,
nome varchar(20) not null,
colore_livrea varchar(20) not null
);

create table piloti(
Id_pilota int primary key auto_increment,
nome varchar(20) not null,
cognome varchar(20) not null,
numero int not null,
nazionalita varchar(20) not null,
id_casa int not null,
foreign key(id_casa) references case_automobilistiche(Id_casa)
);

create table gare(
Id_gara int primary key auto_increment,
nome_gara varchar(20) not null,
circuito varchar(20) not null,
data date not null
);

create table partecipazione(
posizione int,
punti_ottenuti int,
tempo_gara varchar(20),
id_gara int not null,
id_pilota int not null,
foreign key(id_gara) references gare(Id_gara),
foreign key(id_pilota) references piloti(Id_pilota)
);