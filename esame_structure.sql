create table cliente 
(

    codice integer primary key auto_increment,
    password varchar(255) not null,
    username varchar(16) not null unique,
    indirizzo varchar(255),
    email varchar(255) not null unique,
    nome_completo varchar(255),
    citta varchar(255),
    codice_postale integer,
    nazione varchar(255)

) Engine = InnoDB;


CREATE TABLE cookies (
    id integer auto_increment primary key,
    hash varchar(255) not null,
    cliente integer not null,
    expires bigint not null
) Engine = InnoDB;

create table casa_editrice
(

	partita_iva varchar(255) primary key,
    num_telefonico integer,
    ind_sede_centrale varchar (255),
    ind_sede_fiscale varchar (255),
    nome varchar(255)

) Engine = InnoDB;


create table fornitore
(

	cf varchar(255) primary key,
    nome varchar(255),
    indirizzo varchar(255)

) Engine = InnoDB;


create table libro
(

	codice bigint primary key,
    giacenza integer,
    titolo varchar(255),
    lingua varchar (255),
    anno_inizio_stampa integer,
    anno_fine_stampa integer,
    anni_di_stampa integer/*sistemare*/,
    tipo_libro integer,
    nome_casa_editrice varchar(255),
    fornitore /* codice fiscale */ varchar(255),
    casa_editrice varchar(255),
    prezzo integer,
    index idx_ft(fornitore),
    index idx_ed(casa_editrice),
    foreign key (fornitore) references fornitore(cf) on delete cascade on update cascade,
    foreign key (casa_editrice) references casa_editrice(partita_iva) on delete cascade on update cascade
    
) Engine = InnoDB;


create table ordini (
	id integer primary KEY AUTO_INCREMENT,
	data timestamp not null default now(),
	cliente integer,
	foreign key(cliente) references cliente(codice) on delete cascade on update cascade
) Engine = InnoDB;

create table dettaglio_ordini (
	id_ordine integer,
    id_libro varchar(1000),
	quantita integer,
	foreign key(id_ordine) references ordini(id) on delete cascade on update cascade
) Engine = InnoDB;

create table dettaglio_ordini (
	id_ordine integer,
    id_libro bigint,
	quantita integer,
	primary key(id_ordine, id_libro),
	foreign key(id_ordine) references ordini(id) on delete cascade on update cascade,
	foreign key(id_libro) references libro(codice) on delete cascade on update cascade
) Engine = InnoDB;


create table ordine_ricevuto(
    userid integer,
    id_ordine varchar(255),
    ordine_stato varchar(25),
    id_libro bigint,
    quantita integer,
    prezzo integer,
    data date,
    nome_completo varchar(255),
    citta varchar(255),
    codice_postale integer,
    nazione varchar (255),
    foreign key(id_libro) references libro(codice) on delete cascade on update cascade,
    foreign key(userid) references cliente(codice) on delete cascade on update cascade
)Engine = InnoDB;

DELIMITER //
create trigger subctractorder
after insert on ordine_ricevuto
for each row
BEGIN
update libro
set giacenza = giacenza - new.quantita
where codice=new.id_libro;
END //
DELIMITER;
