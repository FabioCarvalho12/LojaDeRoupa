-- Cria o banco de dados loja_de_roupas
CREATE DATABASE loja_de_roupas;

-- Seleciona o banco de dados loja_de_roupas
USE loja_de_roupas;

-- Cria a tabela produtos com os campos id, tipo, modelo, tamanho, quantidade e preco
CREATE TABLE produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    tamanho VARCHAR(10) NOT NULL,
    quantidade INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);
