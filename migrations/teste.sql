CREATE DATABASE kevigo_db;
use kevigo_db;

-- Criar tabela usuário
create table usuarios
(
	id_user int auto_increment not null unique,
    nome_user varchar(50) not null,
    email_user varchar(50)  not null,
    senha_user varchar(256) not null,
    primary key(email_user)
);

create table status_projetos(
id_sta_proj int primary key auto_increment not null,
status_proj varchar(30) not null
);

-- Criar tabela de projetos
create table projetos(
id_proj int primary key auto_increment not null,
nome_proj varchar(40) not null,
img_proj varchar(200),
descricao_proj longtext,
link_proj varchar(240),
fk_status_proj int not null,
fk_user varchar(50),
foreign key(fk_status_proj) references status_projetos(id_sta_proj),
foreign key(fk_user) references usuarios(email_user)
);

-- Criar tabela de Artigos
create table artigos(
id_art int primary key auto_increment not null,
nome_art varchar(40) not null,
local_art varchar(200) not null,
introducao_art varchar(240),
fk_user varchar(50),
foreign key(fk_user) references usuarios(email_user)
);

-- Tabela Links
CREATE TABLE IF NOT EXISTS links (
  id_link INT NOT NULL,
  nome_link VARCHAR(40) NOT NULL,
  endereco_link VARCHAR(110) NOT NULL,
  PRIMARY KEY (id_link)
  );

-- Tabelas relacionadas ao perfil do usuário
create table perfis(
    id_per int primary key auto_increment not null,
    especialidade_per varchar(40),
    biografia_per longtext,
    fk_user int not null,
    fk_link int not null,
    foreign key(fk_user) references usuarios(id_user),
    foreign key(fk_link) references links(id_link)
);

CREATE TABLE IF NOT EXISTS tecnologias
(
id_tec INT NOT NULL,
nome_tec VARCHAR(60) NOT NULL,
PRIMARY KEY (id_tec)
);

CREATE TABLE IF NOT EXISTS perfis_tecnologias 
(
  id_tec_per INT NOT NULL,
  fk_per VARCHAR(50) NOT NULL,
  fk_tec INT NOT NULL,
  PRIMARY KEY(id_tec_per),
  FOREIGN KEY(fk_per) references usuarios(email_user),
  FOREIGN KEY(fk_tec) references tecnologias(id_tec)
);

-- Tabela idiomas 
CREATE TABLE IF NOT EXISTS idiomas (
  id_idio INT NOT NULL,
  nome_idio VARCHAR(60) NULL,
  PRIMARY KEY (id_idio)
  );


-- Tabela Perfis Idiomas
CREATE TABLE IF NOT EXISTS perfis_idiomas (
  fk_user VARCHAR(60) NOT NULL,
  fk_idio INT NOT NULL,
  id_idio_per INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id_idio_per),
    FOREIGN KEY (fk_user) references usuarios (email_user),
    FOREIGN KEY (fk_idio) references idiomas (id_idio)
    );

-- Carregar dados na tabela de status_projetos
insert into status_projetos (status_proj)VALUES("Concluído");
insert into status_projetos (status_proj)VALUES("Em andamento");
insert into status_projetos (status_proj)VALUES("Processo de atualização");

select*from usuarios;