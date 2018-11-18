-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Nov-2018 às 20:20
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estagio_ufms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_aluno` (`RGAALUNO` VARCHAR(25), `sem_atual` VARCHAR(25), `cursos_codCurso` INT, `cpf` VARCHAR(45), `rg` VARCHAR(45), `nome` VARCHAR(45), `email` VARCHAR(45), `senha` LONGTEXT, `id_acao` INT, `rua` VARCHAR(45), `numero` VARCHAR(45), `bairro` VARCHAR(45), `cidade` VARCHAR(25), `cep` VARCHAR(45), `estado` VARCHAR(45), `complemento` VARCHAR(45), `telefoneAluno` VARCHAR(15))  begin
        DECLARE cpfaux INT;
        DECLARE RGA VARCHAR(20);
        DECLARE COORDENADOR INT;
        set @usuario = (select insert_Usuario(cpf,rg,nome,email,senha,id_acao));
        
        insert into alunos(rga, semestreAtual, users_cpf, cursos_codCurso, created_at, updated_at, deleted_at) 
        values(RGAALUNO,sem_atual,@usuario,cursos_codCurso, NOW(), NOW(), NULL); 
        select alunos.rga INTO RGA FROM alunos where alunos.rga = RGAALUNO;
        
        set @idendereco = (select INSERT_ENDERECO(rua,numero,bairro,cidade,cep,estado,complemento,NULL));
        set @telefone = (select Insert_Telefone(telefoneAluno));
        
        set COORDENADOR = (select select_coordenador_curso(cursos_codCurso));
        call insert_aluno_has_endereco (RGA, @idendereco);
        call insert_aluno_has_telefone (RGA, @telefone);
        call insert_estagio(RGA, COORDENADOR);
        
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_aluno_has_endereco` (`rga` VARCHAR(20), `id_endereco` INT)  begin	
        insert into alunos_has_enderecos(alunos_rga,enderecos_idendereco, created_at, updated_at, deleted_at) 
        values(rga,id_endereco,NOW(), NOW(), NULL);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_aluno_has_telefone` (`rga` VARCHAR(25), `telefone` VARCHAR(15))  begin
        insert into alunos_has_telefones(alunos_rga,telefones_telefone, created_at, updated_at, deleted_at) 
        values(rga,telefone, NOW(), NOW(), NULL);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_aluno_has_vagas` (`ALUNO_RGA` VARCHAR(20), `IDVAGA` INT)  begin
         insert into alunos_has_vagas(alunos_rga, vagas_idVagas, created_at, updated_at, deleted_at) 
             values(ALUNO_RGA, IDVAGA, NOW(), NOW(), NULL);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_CAMPUS` (`NOME` VARCHAR(45), `DIRETOR` VARCHAR(45), `EMAILDIRECAO` VARCHAR(45), `SITE` VARCHAR(45), `INSTITUICAO` VARCHAR(45), `RUA` VARCHAR(45), `NUMERO` VARCHAR(45), `BAIRRO` VARCHAR(45), `CIDADE` VARCHAR(45), `ESTADO` VARCHAR(45), `CEP` VARCHAR(45), `TELEFONE` VARCHAR(15), `COMPLEMENTO` VARCHAR(45))  begin
        DECLARE CAMPUS VARCHAR(45);
        DECLARE telefoneaux VARCHAR(15);
        DECLARE endaux INT;
        
        INSERT INTO campus(nome, diretor, emaildirecao, site, instituicao_CNPJ,created_at, updated_at, deleted_at) 
        VALUES(NOME, DIRETOR, EMAILDIRECAO, SITE, INSTITUICAO,NOW(), NOW(), NULL);
        
        SELECT campus.nome INTO CAMPUS from campus where campus.nome = NOME;
        
        set endaux = (select INSERT_ENDERECO(RUA, NUMERO, BAIRRO, CIDADE, ESTADO, CEP,COMPLEMENTO, CAMPUS));
        
        set telefoneaux = (select Insert_Telefone(TELEFONE));
        
        call insert_campus_has_telefones(CAMPUS, telefoneaux);
        
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_campus_has_telefones` (`CAMPUS` VARCHAR(45), `TELEFONE` VARCHAR(15))  begin     
        insert into campus_has_telefones(campus_nome, telefones_telefone, created_at, updated_at, deleted_at) 
        values(CAMPUS,TELEFONE, NOW(), NOW(), NULL);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Coordenadores` (`cpf` VARCHAR(45), `rg` VARCHAR(45), `nome` VARCHAR(45), `email` VARCHAR(45), `senha` LONGTEXT, `id_acao` INT, `intSIAPE_Coo` INT, `Cargo_Coo` VARCHAR(45), `cursos_codCurso` INT)  BEGIN
        
        set @usuario = (select insert_Usuario(cpf,rg,nome,email,senha,id_acao));
        
        insert into coordenadores(SIAPE, Cargo, users_cpf, cursos_codCurso, created_at, updated_at, deleted_at) 
        values(intSIAPE_Coo, Cargo_Coo, @usuario, cursos_codCurso, NOW(), NOW(), NULL);
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_CURSOS` (`COD_CURSO` INT, `REGULAMENTO` TEXT, `NOME_CURSO` VARCHAR(150), `CAMPUS_NOME` VARCHAR(45))  begin
        DECLARE CURSO INT;
        
        INSERT INTO cursos(codCurso, nomeCurso, regulamentoEstagio, campus_nome,created_at, updated_at, deleted_at) 
        VALUES(COD_CURSO, NOME_CURSO, REGULAMENTO, CAMPUS_NOME,NOW(), NOW(), NULL);
        
        SELECT codCurso INTO CURSO from cursos where cursos.codCurso = COD_CURSO;
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_empresas_has_enderecos` (`EMPRESA_CNPJ` VARCHAR(45), `IDENDERECO` INT)  begin	
        insert into empresas_has_enderecos(emp_cnpj, enderecos_idendereco, created_at, updated_at, deleted_at) 
        values(EMPRESA_CNPJ, IDENDERECO, NOW(), NOW(), NULL); 
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_estagio` (`ALUNO_RGA` VARCHAR(20), `COORDENADOR` INT)  begin	
        insert into estagios(data_inicio, data_fim, alunos_rga, supervisor,coordenadores_SIAPE, created_at, updated_at, deleted_at) 
        values(NULL,NULL, ALUNO_RGA, NULL, COORDENADOR, NOW(), NOW(), NULL);
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_frequencia` (`DATA_INICIO` DATETIME, `DATA_FIM` DATETIME, `DESCRICAO_ALUNO` TEXT, `IDESTAGIO` INT)  begin	
         insert into frequencias(Data_inicio, data_fim, Descricao_aluno, Descricao_Supervisor, status, estagio_idestagio, 
             created_at, updated_at, deleted_at) 
             values(DATA_INICIO,DATA_FIM, DESCRICAO_ALUNO, NULL, NULL, IDESTAGIO, NOW(), NOW(), NULL);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_INSTITUICAO` (`CNPJ` VARCHAR(45), `RAZAO_SOCIAL` VARCHAR(45), `EMAIL` VARCHAR(45), `SITE` VARCHAR(45), `TIPO_ENSINO` ENUM("Pub","Pri"), `RUA` VARCHAR(45), `NUMERO` VARCHAR(45), `BAIRRO` VARCHAR(45), `CIDADE` VARCHAR(45), `ESTADO` VARCHAR(45), `CEP` VARCHAR(45), `TELEFONE` VARCHAR(15), `COMPLEMENTO` VARCHAR(50), `CAMPUS_NOME` VARCHAR(45))  begin
        DECLARE idendereco INT;
        DECLARE CNPJINS VARCHAR(45);
        DECLARE telefoneaux VARCHAR(15);
        
        set idendereco = (select INSERT_ENDERECO(RUA, NUMERO, BAIRRO, CIDADE,
        ESTADO, CEP, COMPLEMENTO, CAMPUS_NOME));
        
        set telefoneaux = (select Insert_Telefone(TELEFONE));
        
        INSERT INTO instituicao(CNPJ,Razao_Social, email, site, tipoEnsino, enderecos_idendereco, created_at, updated_at, deleted_at) 
        VALUES(CNPJ, RAZAO_SOCIAL, EMAIL, SITE, TIPO_ENSINO, idendereco, NOW(), NOW(), NULL);
        
        select instituicao.CNPJ INTO CNPJINS FROM instituicao where instituicao.CNPJ = CNPJ;
        
        call insert_telefones_has_instituicoes(telefoneaux, CNPJINS);
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_roles` (`NOME` VARCHAR(100))  begin   
     insert into roles(nome, created_at, updated_at, deleted_at) 
     values(NOME, NOW(), NOW(), NULL);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Supervisor` (`cargo` VARCHAR(45), `areaAtuacao` VARCHAR(45), `cpfis` VARCHAR(45), `rg` VARCHAR(45), `nome` VARCHAR(45), `email` VARCHAR(45), `senha` LONGTEXT, `acao_idacao` VARCHAR(45), `cnpj` VARCHAR(45), `nomeEmpresa` VARCHAR(45), `nome_repre` VARCHAR(45), `ramo` VARCHAR(45), `rua` VARCHAR(45), `numero` VARCHAR(45), `bairro` VARCHAR(45), `cidade` VARCHAR(25), `cep` VARCHAR(45), `estado` VARCHAR(45), `complemento` VARCHAR(45), `telefone` VARCHAR(45))  begin
            declare people varchar(45);
            declare company varchar(45);
        
            set people = (select insert_Usuario(cpfis, rg, nome, email, senha, acao_idacao));
            set company = (select insert_Empresa(cnpj, nomeEmpresa, nome_repre, ramo,rua,numero, bairro, 
                cidade,cep, estado, complemento, telefone));
            
        
            insert into supervisores(Cargo, Area_Atuacao, empresas_cnpj, users_cpf, created_at, updated_at, deleted_at) 
                values(cargo, areaAtuacao, company, people,NOW(), NOW(), NULL);
        
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_telefones_has_instituicoes` (`Tel_TI` VARCHAR(15), `InstCNPJ_TI` VARCHAR(45))  begin
        insert into telefones_has_instituicoes(tel_telefone, instituicao_CNPJ, created_at, updated_at, deleted_at) 
            values(Tel_TI, InstCNPJ_TI,NOW(), NOW(), NULL);  
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_telefone_has_empresa` (`telefone` VARCHAR(15), `cnpj` VARCHAR(45))  begin
         insert into telefones_has_empresas(telefones_telefone,empresas_cnpj, created_at, updated_at, deleted_at) 
             values(telefone,cnpj,NOW(), NOW(), NULL);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_vagas` (`TITULO` VARCHAR(100), `AREA` VARCHAR(100), `REQUISITOS` TEXT, `SUPERVISOR` VARCHAR(45))  begin     
         insert into vagas(Titulo, Area, requisitos_para_vaga, supervisor, created_at, updated_at, deleted_at) 
             values(TITULO,AREA, REQUISITOS, SUPERVISOR, NOW(), NOW(), NULL);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reprova_aluno_has_vagas` (`IDVAGA` INT)  begin	
         UPDATE alunos_has_vagas SET status = "R", updated_at = NOW()
         WHERE  vagas_idVagas = IDVAGA AND status = "EA";
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_alunos_has_vagas` (`STATUS` ENUM("A","R"), `ALUNO_RGA` VARCHAR(20), `VAGAID` INT)  begin
        
        UPDATE alunos_has_vagas SET status = STATUS, updated_at = NOW()
        WHERE  alunos_rga = ALUNO_RGA and vagas_idVagas = VAGAID;
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_estagio` (`DATA_INICIO` DATETIME, `DATA_FIM` DATETIME, `STATUS` ENUM("A","CA","CR"), `ALUNO_RGA` VARCHAR(20), `SUPERVISOR` INT)  begin
        
        UPDATE estagios SET data_inicio = DATA_INICIO, data_fim = DATA_FIM, status = STATUS, supervisores_idSupervisor = SUPERVISOR, 
        updated_at = NOW()
        WHERE alunos_rga = ALUNO_RGA;
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_frequencia` (`IDFREQUENCIA` INT, `DESCRICAO_SUPERVISOR` TEXT, `STATUS` ENUM("A"))  begin
        
        UPDATE frequencias SET Descricao_Supervisor = DESCRICAO_SUPERVISOR, status = STATUS, updated_at = NOW()
        WHERE  frequencias.idFrequencia = IDFREQUENCIA;
        
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_status_vaga` (`STATUS` ENUM("A","E"), `IDVAGA` INT)  begin	
        UPDATE vagas SET status = STATUS, updated_at = NOW()
        WHERE  idVagas = IDVAGA;
        
        IF STATUS = "E" THEN
        call reprova_aluno_has_vagas(IDVAGA);
        END IF;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_vagas` (`TITULO` VARCHAR(100), `AREA` VARCHAR(100), `REQUISITOS` TEXT, `STATUS` ENUM("A","E"), `IDVAGA` INT)  begin
        UPDATE vagas SET Titulo = TITULO, Area = AREA, Requisitos_para_vaga = REQUISITOS, status = STATUS, updated_at = NOW()
        WHERE  idVagas = IDVAGA;
    END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `insert_Empresa` (`cnpjEmpresa` VARCHAR(45), `nome` VARCHAR(45), `nome_repre` VARCHAR(45), `ramo` VARCHAR(45), `rua` VARCHAR(45), `numero` VARCHAR(45), `bairro` VARCHAR(45), `cidade` VARCHAR(25), `cep` VARCHAR(45), `estado` VARCHAR(45), `complemento` VARCHAR(45), `telefone` VARCHAR(45)) RETURNS VARCHAR(45) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci begin
        declare cnpjaux varchar(45);
        insert into empresas(cnpj, nome, nome_representante, ramo, created_at, updated_at, deleted_at) 
        values(cnpjEmpresa, nome, nome_repre, ramo, NOW(), NOW(), NULL); 
        select empresas.cnpj into cnpjaux from empresas where empresas.cnpj = cnpj;
        
        set @idendereco = (select INSERT_ENDERECO(rua,numero,bairro,cidade,cep,estado,complemento,NULL));
        set @telefone = (select Insert_Telefone(telefone));
        
        call insert_empresas_has_enderecos(cnpjaux, @idendereco);
        call insert_telefone_has_empresa(@telefone, cnpjaux);
        
        return cnpjaux;
        end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `INSERT_ENDERECO` (`RUA` VARCHAR(100), `NUMERO` VARCHAR(45), `BAIRRO` VARCHAR(100), `CIDADE` VARCHAR(45), `ESTADO` VARCHAR(45), `CEP` VARCHAR(45), `COMPLEMENTO` VARCHAR(100), `CAMPUS_NOME` VARCHAR(45)) RETURNS INT(11) begin
        DECLARE enderecoaux INT;
        INSERT INTO enderecos(rua,numero,bairro,cidade,cep,estado,complemento,campus_nome, created_at, updated_at, deleted_at) 
        VALUES(RUA, NUMERO, BAIRRO, CIDADE, CEP, ESTADO, COMPLEMENTO,CAMPUS_NOME, NOW(), NOW(), NULL);
        
        SELECT MAX(idendereco) INTO enderecoaux FROM enderecos;
        RETURN enderecoaux;
        END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Insert_Telefone` (`Telefone_IT` VARCHAR(15)) RETURNS VARCHAR(15) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci begin
        
        DECLARE telaux varchar(15);
        
        insert into telefones(telefone, created_at, updated_at, deleted_at) values(Telefone_IT, NOW(), NOW(), NULL);
        
        select telefones.telefone into telaux from telefones where telefones.telefone = Telefone_IT;
        
        return telaux;
        end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `insert_Usuario` (`cpfis` VARCHAR(45), `rg` VARCHAR(45), `nome` VARCHAR(45), `email` VARCHAR(45), `senha` LONGTEXT, `acao_idacao` INT) RETURNS VARCHAR(45) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci begin
        declare pessoa_fisica varchar(45);
        insert into users(cpf, rg, name, email, password, remember_token, roles_idrole, created_at, updated_at, deleted_at) 
        values(cpfis, rg, nome, email, senha, remember_token, acao_idacao, NOW(), NOW(), NULL);
        
        select cpf into pessoa_fisica from users where cpf=cpfis;
      
        return pessoa_fisica; 
    end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `select_coordenador_curso` (`CURSOID` INT) RETURNS INT(11) begin
        DECLARE COORDENADORID INT;
       
        SELECT SIAPE INTO COORDENADORID FROM coordenadores INNER JOIN cursos on codCurso = cursos_codCurso;
        RETURN COORDENADORID;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `rga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semestreAtual` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_cpf` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cursos_codCurso` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos_has_enderecos`
--

CREATE TABLE `alunos_has_enderecos` (
  `alunos_rga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enderecos_idendereco` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos_has_telefones`
--

CREATE TABLE `alunos_has_telefones` (
  `alunos_rga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefones_telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos_has_vagas`
--

CREATE TABLE `alunos_has_vagas` (
  `alunos_rga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vagas_idVagas` int(11) NOT NULL,
  `status` enum('A','EA','R') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `alunos_has_vagas`
--
DELIMITER $$
CREATE TRIGGER `tr_status_aluno_has_vagas` BEFORE INSERT ON `alunos_has_vagas` FOR EACH ROW BEGIN
          SET NEW.status = "EA";
         END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `idarquivo` int(11) NOT NULL,
  `tipo_arquivo` enum('TC','PA','RFA','RFS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `arquivo` blob NOT NULL,
  `alunos_rga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campus`
--

CREATE TABLE `campus` (
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diretor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailDirecao` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instituicao_CNPJ` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `campus`
--

INSERT INTO `campus` (`nome`, `diretor`, `emailDirecao`, `site`, `instituicao_CNPJ`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Câmpus de Aquidauana', 'Professor Dr. Auri Claudionei Matos Frübel', 'auri.frubel@ufms.br', 'cpaq.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('Câmpus de Chapadão do Sul', 'Kleber Augusto Gastaldi', 'kleber.gastaldi@ufms.br', 'cpcs.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('Câmpus de Coxim', 'Prof. Dra. Eliene Dias de Oliveira', 'cpcx@ufms.br', 'cpcx.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('Câmpus de Naviraí', 'Daniel Henrique Lopes', '', 'cpnv.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('Câmpus de Nova Andradina', 'Solange Fachin', 'direcao.cpna@ufms.br', 'cpna.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('Câmpus de Paranaíba', 'Prof.ª Dr.ª Andréia Cristina Ribeiro', '', 'cpar.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('Câmpus de Ponta Porã', 'Cláudia Carreira da Rosa', 'cppp@ufms.br', 'cppp.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('Câmpus de Três Lagoas', 'Prof. Dr. Osmar Jesus Macedo', ' gab.cptl@ufms.br', 'cptl.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('Câmpus do Pantanal – Corumbá', 'Professor Dr. Aguinaldo Silva', 'secdir.cpan@ufms.br', 'cpan.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('Cidade Universitária – Campo Grande', 'Professor Marcelo Augusto Santos Turine', 'reitoria@ufms.br', 'www.ufms.br', '15.461.510/0001-33', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `campus_has_telefones`
--

CREATE TABLE `campus_has_telefones` (
  `campus_nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefones_telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `campus_has_telefones`
--

INSERT INTO `campus_has_telefones` (`campus_nome`, `telefones_telefone`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Câmpus de Aquidauana', '(067) 3241-0450', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('Câmpus de Chapadão do Sul', '(67) 3562-6300', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('Câmpus de Coxim', '(067) 3291-0202', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('Câmpus de Naviraí', '(67) 3409-3401', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('Câmpus de Nova Andradina', '(067) 3349-0500', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('Câmpus de Paranaíba', '(67) 3669-0102', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('Câmpus de Ponta Porã', '(067) 3437-1700', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('Câmpus de Três Lagoas', '(67) 3509-3400', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('Câmpus do Pantanal – Corumbá', '(067) 3234-6813', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('Cidade Universitária – Campo Grande', '(67) 3345-7000', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenadores`
--

CREATE TABLE `coordenadores` (
  `SIAPE` int(11) NOT NULL,
  `Cargo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_cpf` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cursos_codCurso` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `codCurso` int(11) NOT NULL,
  `nomeCurso` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regulamentoEstagio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `campus_nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`codCurso`, `nomeCurso`, `regulamentoEstagio`, `campus_nome`, `created_at`, `updated_at`, `deleted_at`) VALUES
(413, 'Letras – Português/Espanhol', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(432, 'Letras – Português/Inglês', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(439, 'História', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(440, 'Letras – Português/Inglês', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(441, 'Letras - Português/Literatura', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(443, 'Geografia', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(446, 'Ciências Biológicas', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(447, 'Matemática', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(448, 'Turismo', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(450, 'Administração', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(451, 'Geografia', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(453, 'Letras – Português/Espanhol', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(457, 'Matemática', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(459, 'Licenciatura Intercultural Indígena', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(460, 'Licenciatura Intercultural Indígena - Linguagens/Educação Intercultural', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(461, 'Licenciatura Intercultural Indígena - Matemática/Educação Intercultural', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(462, 'Licenciatura Intercultural Indígena - Ciências da Natureza/Educação Intercultural', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(463, 'Licenciatura Intercultural Indígena - Ciências Sociais/Educação Intercultural', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:38', '2018-11-18 19:19:38', NULL),
(464, 'Turismo', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(513, 'Letras – Português/Espanhol', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(525, 'Letras – Português/Inglês', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(541, 'Direito', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(547, 'Administração', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(548, 'Ciências Contábeis', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(549, 'Geografia', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(550, 'História', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(551, 'Letras – Português/Inglês', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(552, 'Ciências Biológicas', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(553, 'Matemática', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(562, 'Psicologia', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(567, 'Letras – Português/Espanhol', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(568, 'Pedagogia', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(569, 'Educação Física', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(570, 'Sistemas de Informação', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(722, 'Letras – Português/Espanhol', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(728, 'Pedagogia', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(739, 'Direito', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(740, 'Letras – Português/Literatura', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(742, 'Letras – Português/Espanhol', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(743, 'Sistemas de Informação', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(744, 'Medicina', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(745, 'Letras – Português/Inglês', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(780, 'Geografia', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(781, 'Direito', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(783, 'História', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(784, 'Letras – Português/Inglês', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(788, 'Ciências Biológicas', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(789, 'Matemática', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(793, 'Administração', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(795, 'Ciências Contábeis', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(796, 'Geografia', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(798, 'Enfermagem', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(799, 'Engenharia de Produção', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(801, 'História', '', 'Câmpus de Coxim', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(802, 'Letras – Português/Espanhol', '', 'Câmpus de Coxim', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(803, 'Sistemas de Informação', '', 'Câmpus de Coxim', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(804, 'Enfermagem', '', 'Câmpus de Coxim', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(805, 'Letras - Português', '', 'Câmpus de Coxim', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(901, 'Administração', '', 'Câmpus de Paranaíba', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(903, 'Psicologia', '', 'Câmpus de Paranaíba', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(904, 'Matemática', '', 'Câmpus de Paranaíba', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(1002, 'Medicina', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(1101, 'Odontologia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(1102, 'Odontologia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(1201, 'Medicina Veterinária', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(1203, 'Zootecnica', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(1302, 'Administração', '', 'Câmpus de Chapadão do Sul', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1303, 'Agronomia', '', 'Câmpus de Chapadão do Sul', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1304, 'Administração', '', 'Câmpus de Chapadão do Sul', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1403, 'Administração', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1404, 'História', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(1405, 'Administração', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1406, 'Gestão Financeira', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(1407, 'Ciências Contábeis', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(1408, 'Engenharia de Produção', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:40', '2018-11-18 19:19:40', NULL),
(1701, 'Ciências Sociais', '', 'Câmpus de Naviraí', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1702, 'Pedagogia', '', 'Câmpus de Naviraí', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1703, 'Administração', '', 'Câmpus de Naviraí', '2018-11-18 19:19:39', '2018-11-18 19:19:39', NULL),
(1801, 'Matemática', '', 'Câmpus de Ponta Porã', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(1802, 'Sistemas de Informação', '', 'Câmpus de Ponta Porã', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(1803, 'Pedagogia', '', 'Câmpus de Ponta Porã', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(1804, 'Ciência da Computação', '', 'Câmpus de Ponta Porã', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(1805, 'Ciência da Computação', '', 'Câmpus de Ponta Porã', '2018-11-18 19:19:41', '2018-11-18 19:19:41', NULL),
(1901, 'Curso Superior de Tecnologia em Redes de Computadores', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(1902, 'Curso Superior de Tecnologia em Análise e Desenvolvimento de Sistemas', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(1904, 'Ciência da Computação', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(1905, 'Engenharia da Computação', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(1906, 'Engenharia de Software', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(1907, 'Sistemas de Informação', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(2001, 'Direito', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(2002, 'Direito', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(2101, 'Arquitetura e Urbanismo', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2102, 'Engenharia Civil', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2103, 'Engenharia Elétrica', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2104, 'Engenharia Ambiental', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2105, 'Curso Superior de Tecnologia em Eletrotécnica Industrial', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2106, 'Engenharia de Produção', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2107, 'Curso Superior de Tecnologia em Construção de Edifícios', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2108, 'Curso Superior de Tecnologia em Saneamento Ambiental', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2109, 'Geografia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2111, 'Engenharia Civil', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2191, 'Geografia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(2201, 'Matemática', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2202, 'Matemática', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2291, 'Matemática', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2301, 'Química', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2302, 'Química', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2401, 'Física', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2402, 'Física', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2501, 'Administração', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(2502, 'Administração', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(2503, 'Turismo', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2504, 'Ciências Contábeis', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2505, 'Curso Superior em Tecnologia em Processos Gerenciais', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2506, 'Ciências Econômicas', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2591, 'Administração Pública', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:42', '2018-11-18 19:19:42', NULL),
(2601, 'Farmácia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2602, 'Nutrição', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(2603, 'Curso Superior em Tecnologia em Alimentos', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2701, 'Ciências Biológicas', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2702, 'Ciências Biológicas', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2703, 'Ciências Biológicas', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2791, 'Ciências Biológicas', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2801, 'Enfermagem', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2802, 'Fisioterapia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:46', '2018-11-18 19:19:46', NULL),
(2901, 'Artes Visuais Licenciatura', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2902, 'Letras – Português/Inglês', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2903, 'Comunicação Social', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2904, 'Artes Visuais', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2905, 'Letras – Português/Espanhol', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2906, 'Música - Licenciatura', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2907, 'Jornalismo', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2908, 'Letras – Português/Espanhol', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2909, 'Letras – Português/Inglês', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(2991, 'Letras – Português/Espanhol', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:43', '2018-11-18 19:19:43', NULL),
(3001, 'Ciências Sociais', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3002, 'História', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3003, 'Psicologia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3004, 'Filosofia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3005, 'Ciências Sociais', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3101, 'Pedagogia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(3102, 'Educação Física', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(3103, 'Pedagogia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(3104, 'Educação do Campo - Licenciatura - Habilitação em Ciências Humanas e Sociais', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3105, 'Educação do Campo - Licenciatura - Habilitação em Linguagens e Códigos', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3106, 'Educação do Campo - Licenciatura - Habilitação em Matemática', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:44', '2018-11-18 19:19:44', NULL),
(3107, 'Educação Física', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(3191, 'Pedagogia', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL),
(3192, 'Educação Física', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:45', '2018-11-18 19:19:45', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `cnpj` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_representante` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ramo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas_has_enderecos`
--

CREATE TABLE `empresas_has_enderecos` (
  `emp_cnpj` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enderecos_idendereco` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `idendereco` int(11) NOT NULL,
  `rua` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campus_nome` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`idendereco`, `rua`, `numero`, `bairro`, `cidade`, `cep`, `estado`, `complemento`, `campus_nome`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Av. Costa e Silva', '', 'Bairro Universitário', 'Campo Grande', '79070-900 ', 'MS', '', NULL, '2018-11-18 19:19:30', '2018-11-18 19:19:30', NULL),
(2, 'Rua Oscar Trindade de Barros', '740', 'Bairro da Serraria', 'Aquidauana', '79200-000', 'MS', '', 'Câmpus de Aquidauana', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
(3, 'Rodovia MS-306', '', '', 'Chapadão do Sul', '79560-000 ', 'MS', '', 'Câmpus de Chapadão do Sul', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
(4, 'Avenida Marcio Lima Nantes', '', 'Vila da Barra', 'Coxim', '79400-000', 'MS', '', 'Câmpus de Coxim', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
(5, 'Rodovia MS 141', 'Km 04', '', 'Naviraí', '79950-000', 'MS', 'Saída para Ivinhema', 'Câmpus de Naviraí', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
(6, ' Avenida Rosilene Lima Oliveira', '64', 'Bairro Universitário', 'Nova Andradina', '79750-000', 'MS', '', 'Câmpus de Nova Andradina', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
(7, 'Avenida Rio Branco', '', 'Bairro Universitário', 'Corumbá', ' 79304-902', 'MS', '', 'Câmpus do Pantanal – Corumbá', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
(8, 'Avenida Pedro Pedrossian', '725', 'Bairro Universitário', 'Paranaíba', '79.500-000', 'MS', '', 'Câmpus de Paranaíba', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
(9, 'Rua Itibiré Vieira', 'BR 463 – Km 4,5', 'Residencial Julia Oliveira Cardinal', 'Ponta Porã', '79907-414', 'MS', '', 'Câmpus de Ponta Porã', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
(10, 'Av Capitão Olinto Mancini', '1662', 'Jardim Primaveril', 'Três Lagoas', '79600-080', 'MS', '', 'Câmpus de Três Lagoas', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
(11, 'Av. Costa e Silva', '', 'Bairro Universitário', 'Campo Grande', '79070-900 ', 'MS', '', 'Cidade Universitária – Campo Grande', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagios`
--

CREATE TABLE `estagios` (
  `idestagio` int(11) NOT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `status` enum('N','PS','A','CA','CR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alunos_rga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordenadores_SIAPE` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `estagios`
--
DELIMITER $$
CREATE TRIGGER `tr_status_estagio` BEFORE INSERT ON `estagios` FOR EACH ROW BEGIN
         SET NEW.status = "N";
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `idFrequencia` int(10) UNSIGNED NOT NULL,
  `Data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `Descricao_aluno` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descricao_Supervisor` text COLLATE utf8mb4_unicode_ci,
  `status` enum('A','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estagio_idestagio` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `frequencias`
--
DELIMITER $$
CREATE TRIGGER `tr_status_frequencia` BEFORE INSERT ON `frequencias` FOR EACH ROW BEGIN
          SET NEW.status = "P";
         END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `CNPJ` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Razao_Social` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoEnsino` enum('Pub','Priv') COLLATE utf8mb4_unicode_ci NOT NULL,
  `enderecos_idendereco` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`CNPJ`, `Razao_Social`, `email`, `site`, `tipoEnsino`, `enderecos_idendereco`, `created_at`, `updated_at`, `deleted_at`) VALUES
('15.461.510/0001-33', 'UNIVERSIDADE FEDERAL DE MATO GROSSO DO SUL', 'reitoria@ufms.br', 'www.ufms.br', 'Pub', 1, '2018-11-18 19:19:30', '2018-11-18 19:19:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `idmensagem` int(11) NOT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci,
  `users_cpf` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2018_11_15_221659_create_alunos_has_enderecos_table', 1),
(8, '2018_11_15_221659_create_alunos_has_telefones_table', 1),
(9, '2018_11_15_221659_create_alunos_has_vagas_table', 1),
(10, '2018_11_15_221659_create_alunos_table', 1),
(11, '2018_11_15_221659_create_arquivos_table', 1),
(12, '2018_11_15_221659_create_campus_has_telefones_table', 1),
(13, '2018_11_15_221659_create_campus_table', 1),
(14, '2018_11_15_221659_create_coordenadores_table', 1),
(15, '2018_11_15_221659_create_cursos_table', 1),
(16, '2018_11_15_221659_create_empresas_has_enderecos_table', 1),
(17, '2018_11_15_221659_create_empresas_table', 1),
(18, '2018_11_15_221659_create_enderecos_table', 1),
(19, '2018_11_15_221659_create_estagios_table', 1),
(20, '2018_11_15_221659_create_frequencias_table', 1),
(21, '2018_11_15_221659_create_instituicao_table', 1),
(22, '2018_11_15_221659_create_mensagens_table', 1),
(23, '2018_11_15_221659_create_roles_table', 1),
(24, '2018_11_15_221659_create_supervisores_table', 1),
(25, '2018_11_15_221659_create_telefones_has_empresas_table', 1),
(26, '2018_11_15_221659_create_telefones_has_instituicoes_table', 1),
(27, '2018_11_15_221659_create_telefones_table', 1),
(28, '2018_11_15_221659_create_users_table', 1),
(29, '2018_11_15_221659_create_vagas_table', 1),
(30, '2018_11_15_221703_add_foreign_keys_to_alunos_has_enderecos_table', 1),
(31, '2018_11_15_221703_add_foreign_keys_to_alunos_has_telefones_table', 1),
(32, '2018_11_15_221703_add_foreign_keys_to_alunos_has_vagas_table', 1),
(33, '2018_11_15_221703_add_foreign_keys_to_alunos_table', 1),
(34, '2018_11_15_221703_add_foreign_keys_to_arquivos_table', 1),
(35, '2018_11_15_221703_add_foreign_keys_to_campus_has_telefones_table', 1),
(36, '2018_11_15_221703_add_foreign_keys_to_campus_table', 1),
(37, '2018_11_15_221703_add_foreign_keys_to_coordenadores_table', 1),
(38, '2018_11_15_221703_add_foreign_keys_to_cursos_table', 1),
(39, '2018_11_15_221703_add_foreign_keys_to_empresas_has_enderecos_table', 1),
(40, '2018_11_15_221703_add_foreign_keys_to_enderecos_table', 1),
(41, '2018_11_15_221703_add_foreign_keys_to_estagios_table', 1),
(42, '2018_11_15_221703_add_foreign_keys_to_frequencias_table', 1),
(43, '2018_11_15_221703_add_foreign_keys_to_instituicao_table', 1),
(44, '2018_11_15_221703_add_foreign_keys_to_mensagens_table', 1),
(45, '2018_11_15_221703_add_foreign_keys_to_supervisores_table', 1),
(46, '2018_11_15_221703_add_foreign_keys_to_telefones_has_empresas_table', 1),
(47, '2018_11_15_221703_add_foreign_keys_to_telefones_has_instituicoes_table', 1),
(48, '2018_11_15_221703_add_foreign_keys_to_users_table', 1),
(49, '2018_11_15_221703_add_foreign_keys_to_vagas_table', 1),
(50, '2018_11_16_160306_create_function_insert_endereco', 1),
(51, '2018_11_16_160330_create_function_insert_telefone', 1),
(52, '2018_11_16_160412_create_procedure_insert_aluno_has_endereco', 1),
(53, '2018_11_16_160436_create_procedure_insert_aluno_has_telefone', 1),
(54, '2018_11_16_160500_create_procedure_insert_campus_has_telefone', 1),
(55, '2018_11_16_160536_create_procedure_insert_empresa_has_endereco', 1),
(56, '2018_11_16_160605_create_procedure_insert_telefone_has_empresa', 1),
(57, '2018_11_16_160630_create_procedure_insert_telefone_has_instituicao', 1),
(58, '2018_11_16_160700_create_procedure_insert_instituicao', 1),
(59, '2018_11_16_160717_create_procedure_insert_campus', 1),
(60, '2018_11_16_160736_create_procedure_insert_curso', 1),
(61, '2018_11_16_161151_create_procedure_insert_role', 1),
(62, '2018_11_16_161221_create_function_insert_usuario', 1),
(63, '2018_11_16_161354_create_procedure_insert_coordenador', 1),
(64, '2018_11_16_161425_create_function_select_coordenador_curso', 1),
(65, '2018_11_16_161459_create_function_insert_empresa', 1),
(66, '2018_11_16_161531_create_procedure_insert_estagio', 1),
(67, '2018_11_16_161544_create_procedure_insert_aluno', 1),
(68, '2018_11_16_161600_create_procedure_insert_supervisor', 1),
(69, '2018_11_16_161812_create_procedure_insert_vaga', 1),
(70, '2018_11_16_161835_create_procedure_insert_aluno_has_vaga', 1),
(71, '2018_11_16_161853_create_procedure_insert_frequencia', 1),
(72, '2018_11_16_161918_create_procedure_update_estagio', 1),
(73, '2018_11_16_161935_create_procedure_update_frequencia', 1),
(74, '2018_11_16_162016_create_procedure_reprova_aluno_has_vaga', 1),
(75, '2018_11_16_162040_create_procedure_update_status_vaga', 1),
(76, '2018_11_16_162058_create_procedure_update_vaga', 1),
(77, '2018_11_16_171806_create_procedure_update_aluno_has_vaga', 1),
(78, '2018_11_16_173043_create_trigger_status_estagio', 1),
(79, '2018_11_16_173115_create_trigger_status_vagas', 1),
(80, '2018_11_16_173143_create_trigger_status_aluno_has_vagas', 1),
(81, '2018_11_16_173159_create_trigger_status_frequencia', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `idrole` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`idrole`, `nome`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Adm', '2018-11-18 19:19:49', '2018-11-18 19:19:49', NULL),
(2, 'Coordenador', '2018-11-18 19:19:49', '2018-11-18 19:19:49', NULL),
(3, 'Aluno', '2018-11-18 19:19:49', '2018-11-18 19:19:49', NULL),
(4, 'Supervisor', '2018-11-18 19:19:50', '2018-11-18 19:19:50', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `supervisores`
--

CREATE TABLE `supervisores` (
  `Cargo` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Area_Atuacao` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_cpf` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresas_cnpj` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones`
--

CREATE TABLE `telefones` (
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `telefones`
--

INSERT INTO `telefones` (`telefone`, `created_at`, `updated_at`, `deleted_at`) VALUES
('(067) 3234-6813', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('(067) 3241-0450', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('(067) 3291-0202', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('(067) 3349-0500', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('(067) 3437-1700', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('(67) 3345-7000', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('(67) 3345-7001', '2018-11-18 19:19:30', '2018-11-18 19:19:30', NULL),
('(67) 3409-3401', '2018-11-18 19:19:34', '2018-11-18 19:19:34', NULL),
('(67) 3509-3400', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL),
('(67) 3562-6300', '2018-11-18 19:19:33', '2018-11-18 19:19:33', NULL),
('(67) 3669-0102', '2018-11-18 19:19:35', '2018-11-18 19:19:35', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones_has_empresas`
--

CREATE TABLE `telefones_has_empresas` (
  `telefones_telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `empresas_cnpj` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones_has_instituicoes`
--

CREATE TABLE `telefones_has_instituicoes` (
  `tel_telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instituicao_CNPJ` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `telefones_has_instituicoes`
--

INSERT INTO `telefones_has_instituicoes` (`tel_telefone`, `instituicao_CNPJ`, `created_at`, `updated_at`, `deleted_at`) VALUES
('(67) 3345-7001', '15.461.510/0001-33', '2018-11-18 19:19:30', '2018-11-18 19:19:30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `cpf` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rg` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles_idrole` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `idVagas` int(11) NOT NULL,
  `Titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Area` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Requisitos_para_Vaga` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','E') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Acionadores `vagas`
--
DELIMITER $$
CREATE TRIGGER `tr_status_vagas` BEFORE INSERT ON `vagas` FOR EACH ROW BEGIN
          SET NEW.status = "A";
         END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`rga`,`users_cpf`),
  ADD KEY `alunos_users_cpf_foreign` (`users_cpf`),
  ADD KEY `alunos_cursos_codcurso_foreign` (`cursos_codCurso`);

--
-- Indexes for table `alunos_has_enderecos`
--
ALTER TABLE `alunos_has_enderecos`
  ADD PRIMARY KEY (`alunos_rga`,`enderecos_idendereco`),
  ADD KEY `alunos_has_enderecos_enderecos_idendereco_foreign` (`enderecos_idendereco`);

--
-- Indexes for table `alunos_has_telefones`
--
ALTER TABLE `alunos_has_telefones`
  ADD PRIMARY KEY (`alunos_rga`,`telefones_telefone`),
  ADD KEY `alunos_has_telefones_telefones_telefone_foreign` (`telefones_telefone`);

--
-- Indexes for table `alunos_has_vagas`
--
ALTER TABLE `alunos_has_vagas`
  ADD PRIMARY KEY (`alunos_rga`,`vagas_idVagas`),
  ADD KEY `alunos_has_vagas_vagas_idvagas_foreign` (`vagas_idVagas`);

--
-- Indexes for table `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`idarquivo`),
  ADD KEY `arquivos_alunos_rga_foreign` (`alunos_rga`),
  ADD KEY `arquivos_supervisor_foreign` (`supervisor`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `campus_instituicao_cnpj_foreign` (`instituicao_CNPJ`);

--
-- Indexes for table `campus_has_telefones`
--
ALTER TABLE `campus_has_telefones`
  ADD PRIMARY KEY (`campus_nome`,`telefones_telefone`),
  ADD KEY `campus_has_telefones_telefones_telefone_foreign` (`telefones_telefone`);

--
-- Indexes for table `coordenadores`
--
ALTER TABLE `coordenadores`
  ADD PRIMARY KEY (`SIAPE`,`users_cpf`),
  ADD KEY `coordenadores_users_cpf_foreign` (`users_cpf`),
  ADD KEY `coordenadores_cursos_codcurso_foreign` (`cursos_codCurso`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codCurso`),
  ADD KEY `cursos_campus_nome_foreign` (`campus_nome`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`cnpj`);

--
-- Indexes for table `empresas_has_enderecos`
--
ALTER TABLE `empresas_has_enderecos`
  ADD PRIMARY KEY (`emp_cnpj`,`enderecos_idendereco`),
  ADD KEY `empresas_has_enderecos_enderecos_idendereco_foreign` (`enderecos_idendereco`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`idendereco`),
  ADD KEY `enderecos_campus_nome_foreign` (`campus_nome`);

--
-- Indexes for table `estagios`
--
ALTER TABLE `estagios`
  ADD PRIMARY KEY (`idestagio`),
  ADD KEY `estagios_alunos_rga_foreign` (`alunos_rga`),
  ADD KEY `estagios_coordenadores_siape_foreign` (`coordenadores_SIAPE`),
  ADD KEY `estagios_supervisor_foreign` (`supervisor`);

--
-- Indexes for table `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`idFrequencia`),
  ADD KEY `frequencias_estagio_idestagio_foreign` (`estagio_idestagio`);

--
-- Indexes for table `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`CNPJ`,`enderecos_idendereco`),
  ADD KEY `instituicao_enderecos_idendereco_foreign` (`enderecos_idendereco`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`idmensagem`),
  ADD KEY `mensagens_users_cpf_foreign` (`users_cpf`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrole`);

--
-- Indexes for table `supervisores`
--
ALTER TABLE `supervisores`
  ADD PRIMARY KEY (`users_cpf`,`empresas_cnpj`),
  ADD KEY `supervisores_empresas_cnpj_foreign` (`empresas_cnpj`);

--
-- Indexes for table `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`telefone`);

--
-- Indexes for table `telefones_has_empresas`
--
ALTER TABLE `telefones_has_empresas`
  ADD PRIMARY KEY (`telefones_telefone`,`empresas_cnpj`),
  ADD KEY `telefones_has_empresas_empresas_cnpj_foreign` (`empresas_cnpj`);

--
-- Indexes for table `telefones_has_instituicoes`
--
ALTER TABLE `telefones_has_instituicoes`
  ADD PRIMARY KEY (`tel_telefone`,`instituicao_CNPJ`),
  ADD KEY `telefones_has_instituicoes_instituicao_cnpj_foreign` (`instituicao_CNPJ`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`cpf`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_roles_idrole_foreign` (`roles_idrole`);

--
-- Indexes for table `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`idVagas`),
  ADD KEY `vagas_supervisor_foreign` (`supervisor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `idarquivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `estagios`
--
ALTER TABLE `estagios`
  MODIFY `idestagio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `idFrequencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `idmensagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `idrole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vagas`
--
ALTER TABLE `vagas`
  MODIFY `idVagas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_cursos_codcurso_foreign` FOREIGN KEY (`cursos_codCurso`) REFERENCES `cursos` (`codCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alunos_users_cpf_foreign` FOREIGN KEY (`users_cpf`) REFERENCES `users` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `alunos_has_enderecos`
--
ALTER TABLE `alunos_has_enderecos`
  ADD CONSTRAINT `alunos_has_enderecos_alunos_rga_foreign` FOREIGN KEY (`alunos_rga`) REFERENCES `alunos` (`rga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alunos_has_enderecos_enderecos_idendereco_foreign` FOREIGN KEY (`enderecos_idendereco`) REFERENCES `enderecos` (`idendereco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `alunos_has_telefones`
--
ALTER TABLE `alunos_has_telefones`
  ADD CONSTRAINT `alunos_has_telefones_alunos_rga_foreign` FOREIGN KEY (`alunos_rga`) REFERENCES `alunos` (`rga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alunos_has_telefones_telefones_telefone_foreign` FOREIGN KEY (`telefones_telefone`) REFERENCES `telefones` (`telefone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `alunos_has_vagas`
--
ALTER TABLE `alunos_has_vagas`
  ADD CONSTRAINT `alunos_has_vagas_alunos_rga_foreign` FOREIGN KEY (`alunos_rga`) REFERENCES `alunos` (`rga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alunos_has_vagas_vagas_idvagas_foreign` FOREIGN KEY (`vagas_idVagas`) REFERENCES `vagas` (`idVagas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `arquivos_alunos_rga_foreign` FOREIGN KEY (`alunos_rga`) REFERENCES `alunos` (`rga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arquivos_supervisor_foreign` FOREIGN KEY (`supervisor`) REFERENCES `supervisores` (`users_cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `campus`
--
ALTER TABLE `campus`
  ADD CONSTRAINT `campus_instituicao_cnpj_foreign` FOREIGN KEY (`instituicao_CNPJ`) REFERENCES `instituicao` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `campus_has_telefones`
--
ALTER TABLE `campus_has_telefones`
  ADD CONSTRAINT `campus_has_telefones_campus_nome_foreign` FOREIGN KEY (`campus_nome`) REFERENCES `campus` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `campus_has_telefones_telefones_telefone_foreign` FOREIGN KEY (`telefones_telefone`) REFERENCES `telefones` (`telefone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `coordenadores`
--
ALTER TABLE `coordenadores`
  ADD CONSTRAINT `coordenadores_cursos_codcurso_foreign` FOREIGN KEY (`cursos_codCurso`) REFERENCES `cursos` (`codCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coordenadores_users_cpf_foreign` FOREIGN KEY (`users_cpf`) REFERENCES `users` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_campus_nome_foreign` FOREIGN KEY (`campus_nome`) REFERENCES `campus` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `empresas_has_enderecos`
--
ALTER TABLE `empresas_has_enderecos`
  ADD CONSTRAINT `empresas_has_enderecos_emp_cnpj_foreign` FOREIGN KEY (`emp_cnpj`) REFERENCES `empresas` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empresas_has_enderecos_enderecos_idendereco_foreign` FOREIGN KEY (`enderecos_idendereco`) REFERENCES `enderecos` (`idendereco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_campus_nome_foreign` FOREIGN KEY (`campus_nome`) REFERENCES `campus` (`nome`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `estagios`
--
ALTER TABLE `estagios`
  ADD CONSTRAINT `estagios_alunos_rga_foreign` FOREIGN KEY (`alunos_rga`) REFERENCES `alunos` (`rga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estagios_coordenadores_siape_foreign` FOREIGN KEY (`coordenadores_SIAPE`) REFERENCES `coordenadores` (`SIAPE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estagios_supervisor_foreign` FOREIGN KEY (`supervisor`) REFERENCES `supervisores` (`users_cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD CONSTRAINT `frequencias_estagio_idestagio_foreign` FOREIGN KEY (`estagio_idestagio`) REFERENCES `estagios` (`idestagio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD CONSTRAINT `instituicao_enderecos_idendereco_foreign` FOREIGN KEY (`enderecos_idendereco`) REFERENCES `enderecos` (`idendereco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_users_cpf_foreign` FOREIGN KEY (`users_cpf`) REFERENCES `users` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `supervisores`
--
ALTER TABLE `supervisores`
  ADD CONSTRAINT `supervisores_empresas_cnpj_foreign` FOREIGN KEY (`empresas_cnpj`) REFERENCES `empresas` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supervisores_users_cpf_foreign` FOREIGN KEY (`users_cpf`) REFERENCES `users` (`cpf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `telefones_has_empresas`
--
ALTER TABLE `telefones_has_empresas`
  ADD CONSTRAINT `telefones_has_empresas_empresas_cnpj_foreign` FOREIGN KEY (`empresas_cnpj`) REFERENCES `empresas` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `telefones_has_empresas_telefones_telefone_foreign` FOREIGN KEY (`telefones_telefone`) REFERENCES `telefones` (`telefone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `telefones_has_instituicoes`
--
ALTER TABLE `telefones_has_instituicoes`
  ADD CONSTRAINT `telefones_has_instituicoes_instituicao_cnpj_foreign` FOREIGN KEY (`instituicao_CNPJ`) REFERENCES `instituicao` (`CNPJ`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `telefones_has_instituicoes_tel_telefone_foreign` FOREIGN KEY (`tel_telefone`) REFERENCES `telefones` (`telefone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_idrole_foreign` FOREIGN KEY (`roles_idrole`) REFERENCES `roles` (`idrole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `vagas_supervisor_foreign` FOREIGN KEY (`supervisor`) REFERENCES `supervisores` (`users_cpf`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
