-- abmusuarios.sql

-- Crea la base de datos
CREATE DATABASE IF NOT EXISTS abmusuarios;

-- Usar la base de datos
USE abmusuarios;

-- Crear la tabla users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,

    PRIMARY KEY (id)
);
