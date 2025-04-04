
use kevigo_db;

-- -- Carregar dados na tabela de usuarios, as senha é 12
insert into usuarios (nome_user,email_user,senha_user)
VALUES("Usuário Teste","teste@gmail.com","$2y$10$3Rx9BYssARCdoJ9J3jkt2u2NngdG/lBKYB8SSu4IU92ORY.R9hif2");

-- Carregar dados na tabela de status_projetos
insert into status_projetos (status_proj)VALUES("Concluído");
insert into status_projetos (status_proj)VALUES("Em andamento");
insert into status_projetos (status_proj)VALUES("Processo de atualização");

-- Carregar dados na tabela perfil
-- insert into perfil (especialidade_per)VALUES("Desenvolvimento de sistemas");

-- Carregar dados na tabela de projetos
INSERT INTO projetos (nome_proj, img_proj, descricao_proj, link_proj, fk_status_proj, fk_user) 
VALUES ("API REST", "api_rest.png", "Esse é o projeto que visa apresentar o funcionamento de uma API rest...", "siteTal.com", 1, "teste@gmail.com");


-- Carregar dados na tabela de artigos
INSERT INTO artigos (nome_art, introducao_art, link_art, fk_user) 
VALUES ("Lógica de Programação", "Nesse artigo será abordado lógica de programação...", "log_pro.pdf", "teste@gmail.com");
