create database fastroute;
use fastroute;

create table sedi(
id_sede int auto_increment primary key,
nome varchar(20) not null,
indirizzo varchar(30) not null,
citta varchar(20) not null,
telefono varchar(20)
);

create table personale(
id_personale int auto_increment primary key,
nome varchar(20) not null,
cognome varchar(20) not null,
email varchar(30) not null unique,
password varchar(20) not null,
ruolo varchar(20) default 'addetto',
colore_sfondo varchar(20) default '#f5f5f5',
primo_accesso tinyint(1) default 1, #tinyint come bool per il login
id_sede int not null,
foreign key (id_sede) references sedi(id_sede)
);

create table clienti(
id_cliente int auto_increment primary key,
nome varchar(20) not null,
cognome varchar(20) not null,
indirizzo varchar(30) not null,
telefono varchar(20),
email varchar(30),
punti_fedelta int default 0
);

create table destinatari(
id_destinatario int auto_increment primary key,
nome varchar(20) not null,
cognome varchar(20) not null,
indirizzo varchar(30) not null,
telefono varchar(20),
email varchar(30)
);

create table plichi(
codice_plico int primary key,
data_ora_accettazione datetime not null,
data_ora_spedizione datetime null,
data_ora_ritiro datetime null,
stato enum('in partenza', 'in transito', 'ritirato') default 'in partenza',
id_cliente int not null,
id_destinatario int not null,
id_sede_partenza int not null,
id_sede_arrivo int not null,
foreign key (id_cliente) references clienti(id_cliente),
foreign key (id_destinatario) references destinatari(id_destinatario),
foreign key (id_sede_partenza) references sedi(id_sede),
foreign key (id_sede_arrivo) references sedi(id_sede)
);

create table richieste_info(
id_richiesta int auto_increment primary key,
nome varchar(20) not null,
email varchar(30) not null,
messaggio text not null,
data_richiesta datetime default current_timestamp
);



insert into sedi(nome, indirizzo, citta, telefono) values
('Sede Rovigo', 'Piazza Tien An Men', 'Rovigo', '1419430088'),
('Sede Roma', 'Quadrato della Concordia', 'Roma', '1930719045');

insert into clienti(nome, cognome, indirizzo, telefono, email, punti_fedelta) values
('Luca', 'Rossi', 'Via Verdi 5, Milano', '3331112222', 'luca@gmail.com', 0),
('Anna', 'Bianchi', 'Via Dante 8, Torino', '3334445555', 'anna@gmail.com', 0);

insert into destinatari(nome, cognome, indirizzo, telefono, email) values
('Marco', 'Neri', 'Via Po 12, Torino', '3337778888', 'marco@gmail.com'),
('Sara', 'Gallo', 'Via Mazzini 4, Milano', '3339990000', 'sara@gmail.com');

insert into personale(nome, cognome, email, password, ruolo, colore_sfondo, primo_accesso, id_sede) values
('Admin', 'FastRoute', 'admin@fastroute.it', '$2y$10$examplehash', 'admin', '#f5f5f5', 0, 1);


