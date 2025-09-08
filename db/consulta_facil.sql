
-- Script para criar o banco de dados e populações iniciais
CREATE DATABASE IF NOT EXISTS consulta_facil DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE consulta_facil;

DROP TABLE IF EXISTS consultas;
DROP TABLE IF EXISTS medicos;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
);

CREATE TABLE medicos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  especialidade VARCHAR(80) NOT NULL,
  localizacao VARCHAR(120) NOT NULL,
  avaliacao_media DECIMAL(2,1) DEFAULT 4.5
);

CREATE TABLE consultas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_medico INT NOT NULL,
  data_hora DATETIME NOT NULL,
  protocolo VARCHAR(20) NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  FOREIGN KEY (id_medico) REFERENCES medicos(id)
);

-- Inserção de médicos de exemplo
INSERT INTO medicos (nome, especialidade, localizacao, avaliacao_media) VALUES
('Dra. Mariana Silva', 'Pediatria', 'Goiânia - Centro', 4.8),
('Dr. Carlos Almeida', 'Cardiologia', 'Goiânia - Setor Oeste', 4.6),
('Dra. Ana Paula', 'Clínica Geral', 'Goiânia - Jardim América', 4.4),
('Dr. Felipe Souza', 'Dermatologia', 'Goiânia - Setor Bueno', 4.7),
('Dra. Marina Costa', 'Ginecologia', 'Goiânia - Setor Leste', 4.5);

-- IMPORTANTE: não inclui usuário de teste com senha por segurança no script.
-- Use a tela de cadastro do frontend para criar um usuário de teste (e-mail e senha).
