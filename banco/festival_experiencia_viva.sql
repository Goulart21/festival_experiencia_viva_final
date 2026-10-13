
CREATE DATABASE IF NOT EXISTS festival_experiencia_viva
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE festival_experiencia_viva;

CREATE TABLE IF NOT EXISTS participantes (
    id_participante INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_participante VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT uq_participantes_email UNIQUE (email),
    
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS atividades (
    id_atividade INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_atividade VARCHAR(255) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    data_atividade DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fim TIME NOT NULL,
    local_atividade VARCHAR(255) NOT NULL,
    capacidade INT UNSIGNED NOT NULL,

    CONSTRAINT chk_atividades_capacidade CHECK (capacidade > 0),
    CONSTRAINT chk_atividades_horario CHECK (hora_fim > hora_inicio)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS inscricoes (
    id_inscricao INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_participante INT UNSIGNED NOT NULL,
    id_atividade INT UNSIGNED NOT NULL,
    data_inscricao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('ATIVA', 'CANCELADA') NOT NULL DEFAULT 'ATIVA',

    CONSTRAINT uq_inscricao_participante_atividade
        UNIQUE (id_participante, id_atividade),

    CONSTRAINT fk_inscricao_participante
        FOREIGN KEY (id_participante)
        REFERENCES participantes (id_participante)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT fk_inscricao_atividade
        FOREIGN KEY (id_atividade)
        REFERENCES atividades (id_atividade)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;
