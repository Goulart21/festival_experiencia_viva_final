

INSERT INTO participantes
    (nome_participante, email, telefone)
VALUES
    ('João da Silva', 'joao.teste@example.com', '31990001001');

SET @participante1 = LAST_INSERT_ID();

INSERT INTO participantes
    (nome_participante, email, telefone)
VALUES
    ('Maria Oliveira', 'maria.teste@example.com', '31990001002');

SET @participante2 = LAST_INSERT_ID();

INSERT INTO participantes
    (nome_participante, email, telefone)
VALUES
    ('Pedro Santos', 'pedro.teste@example.com', '31990001003');

-- =========================================
-- 2. ATIVIDADES
-- =========================================

-- Capacidade 2: ficará sem vagas após duas inscrições.
INSERT INTO atividades
    (nome_atividade, descricao, data_atividade,
     hora_inicio, hora_fim, local_atividade, capacidade)
VALUES
    ('Oficina de Gastronomia',
     'Preparação de receitas culinárias',
     '2026-11-20',
     '14:00:00',
     '16:00:00',
     'Sala 1',
     2);



INSERT INTO atividades
    (nome_atividade, descricao, data_atividade,
     hora_inicio, hora_fim, local_atividade, capacidade)
VALUES
    ('Introdução à Tecnologia',
     'Atividade sobre inovação e tecnologia',
     '2026-11-21',
     '09:00:00',
     '11:00:00',
     'Laboratório 1',
     10);


INSERT INTO atividades
    (nome_atividade, descricao, data_atividade,
     hora_inicio, hora_fim, local_atividade, capacidade)
VALUES
    ('Bem-estar e Relaxamento',
     'Práticas de relaxamento e bem-estar',
     '2026-11-22',
     '13:00:00',
     '15:00:00',
     'Sala 3',
     5);


-- =========================================
-- 3. INSCRIÇÕES
-- =========================================

-- Duas inscrições para a atividade com capacidade 2.
INSERT INTO inscricoes
    (id_participante, id_atividade, status)
VALUES
    (1, 1, 'ATIVA');

INSERT INTO inscricoes
    (id_participante, id_atividade, status)
VALUES
    (2, 1, 'ATIVA');

-- Inscrições em outras atividades.
INSERT INTO inscricoes
    (id_participante, id_atividade, status)
VALUES
    (3, 2, 'ATIVA');

INSERT INTO inscricoes
    (id_participante, id_atividade, status)
VALUES
    (1, 3, 'ATIVA');


-- =========================================
-- 4. CONFERIR OS DADOS INSERIDOS
-- =========================================


select * from participantes;
select * from atividades;
SELECT
    i.id_inscricao,
    p.nome_participante,
    a.nome_atividade,
    a.capacidade,
    i.data_inscricao,
    i.status
FROM inscricoes AS i
INNER JOIN participantes AS p
    ON i.id_participante = p.id_participante
INNER JOIN atividades AS a
    ON i.id_atividade = a.id_atividade
ORDER BY i.id_inscricao;