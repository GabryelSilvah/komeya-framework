CREATE DATABASE kevigo_db;
use kevigo_db;

-- Criar tabela usuário
create table usuarios
(
	id_user int AUTO_INCREMENT not null unique,
    nome_user varchar(50) not null,
    email_user varchar(50)  not null,
    senha_user varchar(256) not null,
    primary key(email_user)
);

-- Status atual do projeto (concluído, em andamento ou em atualização)
create table status_projetos(
id_sta_proj int primary key AUTO_INCREMENT not null,
status_proj varchar(30) not null
);

-- Criar tabela de projetos
create table projetos(
id_proj int primary key AUTO_INCREMENT not null,
nome_proj varchar(40) not null,
img_proj varchar(150),
descricao_proj longtext,
link_proj varchar(200),
fk_status_proj int not null,
fk_user varchar(50),
foreign key(fk_status_proj) references status_projetos(id_sta_proj) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key(fk_user) references usuarios(email_user) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Criar tabela de Artigos
create table artigos(
id_art int primary key AUTO_INCREMENT not null,
nome_art varchar(40) not null,
local_art varchar(150) not null,
introducao_art varchar(240),
fk_user varchar(50),
foreign key(fk_user) references usuarios(email_user) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabelas relacionadas ao perfil do usuário
create table perfis(
    id_per int primary key AUTO_INCREMENT not null,
    especialidade_per varchar(40),
    biografia_per longtext,
    fk_user varchar(60) not null,
    foreign key(fk_user) references usuarios(email_user) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Lista de tecologias no nosso catálogo
CREATE TABLE IF NOT EXISTS tecnologias
(
id_tec INT NOT NULL AUTO_INCREMENT,
nome_tec VARCHAR(60) NOT NULL,
PRIMARY KEY (id_tec)
);

-- Tabela gerada a partir do relacionamento n:n usuario x tecnologias
CREATE TABLE IF NOT EXISTS perfis_tecnologias 
(
  id_tec_per INT NOT NULL AUTO_INCREMENT,
  fk_per VARCHAR(50) NOT NULL,
  fk_tec INT NOT NULL,
  PRIMARY KEY(id_tec_per),
  FOREIGN KEY(fk_per) references usuarios(email_user) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(fk_tec) references tecnologias(id_tec) ON DELETE CASCADE ON UPDATE CASCADE
);


-- Tabela Links
CREATE TABLE IF NOT EXISTS links (
  id_link INT NOT NULL AUTO_INCREMENT,
  nome_link VARCHAR(40) NOT NULL,
  endereco_link VARCHAR(110) NOT NULL,
  PRIMARY KEY (id_link)
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
    FOREIGN KEY (fk_user) references usuarios (email_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_idio) references idiomas (id_idio) ON DELETE CASCADE ON UPDATE CASCADE
    );


-- Carregar dados na tabela de status_projetos
insert into status_projetos (status_proj)VALUES("Concluído");
insert into status_projetos (status_proj)VALUES("Em andamento");
insert into status_projetos (status_proj)VALUES("Processo de atualização");


