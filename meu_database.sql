-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS tecnotech;
USE tecnotech;

-- Criação da tabela Associado
CREATE TABLE IF NOT EXISTS Associado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE,
    data_filiacao DATE NOT NULL
);

-- Criação da tabela Anuidade
CREATE TABLE IF NOT EXISTS Anuidade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ano YEAR NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);

-- Criação da tabela intermediária Associado_Anuidade
CREATE TABLE IF NOT EXISTS Associado_Anuidade (
    associado_id INT NOT NULL,
    anuidade_id INT NOT NULL,
    quitado BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (associado_id, anuidade_id),
    FOREIGN KEY (associado_id) REFERENCES Associado(id) ON DELETE CASCADE,
    FOREIGN KEY (anuidade_id) REFERENCES Anuidade(id) ON DELETE CASCADE
);
