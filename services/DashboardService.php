<?php

class DashboardService
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obterTotais(): array
    {
        $sql = "SELECT
                (SELECT COUNT(*) FROM participantes) AS total_participantes,
                (SELECT COUNT(*) FROM atividades) AS total_atividades,
                (SELECT COUNT(*) FROM inscricoes WHERE status = 'ATIVA') AS inscricoes_ativas";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarOcupacaoAtividades(): array
    {
        $sql = "SELECT
                a.id_atividade,
                a.nome_atividade,
                a.data_atividade,
                a.hora_inicio,
                a.capacidade,
                COUNT(i.id_inscricao) AS inscritos,
                ROUND(COUNT(i.id_inscricao) / a.capacidade * 100) AS percentual
            FROM atividades AS a
            LEFT JOIN inscricoes AS i
                ON i.id_atividade = a.id_atividade
                AND i.status = 'ATIVA'
            GROUP BY
                a.id_atividade,
                a.nome_atividade,
                a.data_atividade,
                a.hora_inicio,
                a.capacidade
            ORDER BY percentual DESC, a.data_atividade, a.hora_inicio";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarUltimasInscricoes(int $limite = 5): array
    {
        $sql = "SELECT
                i.id_inscricao,
                p.nome_participante,
                a.nome_atividade,
                i.data_inscricao,
                i.status
            FROM inscricoes AS i
            INNER JOIN participantes AS p
                ON i.id_participante = p.id_participante
            INNER JOIN atividades AS a
                ON i.id_atividade = a.id_atividade
            ORDER BY i.id_inscricao DESC
            LIMIT :limite";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}