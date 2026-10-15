
<?php

require_once __DIR__ . '/../models/Participante.php';

class ParticipanteService
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function cadastrarParticipante(Participante $participante): string
    {

        $sql = "SELECT COUNT(*) FROM 
        participantes WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $participante->getEmail()
        ]);

        if ($stmt->fetchColumn() > 0) {

            return 'EMAIL_DUPLICADO';
        }

        $sql = "INSERT INTO participantes (nome_participante, email, telefone) VALUES (:nome_participante, :email, :telefone)";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':nome_participante' => $participante->getNomeParticipante(),
            ':email' => $participante->getEmail(),
            ':telefone' => $participante->getTelefone()
        ])) {
            return 'SUCESSO';
        }

        return 'ERRO_CADASTRAR';
    }

    public function listarParticipantes(): array
    {

        $sql = "SELECT * FROM participantes ORDER BY nome_participante";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarParticipantePorId(int $id_participante): ?array
    {

        $sql = "SELECT * FROM participantes WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id_participante
        ]);

        $participanteId = $stmt->fetch(PDO::FETCH_ASSOC);

        return $participanteId ?: null;
    }

    public function atualizarParticipante(int $id_participante, Participante $participante): string
    {


        $sql = "SELECT * FROM participantes WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id_participante
        ]);

        if ($stmt->fetch(PDO::FETCH_ASSOC) === false) {

            return 'NAO_ENCONTRADO';
        }

        $sql = "SELECT COUNT(*)
        FROM participantes
        WHERE email = :email
        AND id_participante <> :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':email' => $participante->getEmail(),
            ':id' => $participante->getIdParticipante()
        ]);

        if ($stmt->fetchColumn() > 0) {

            return 'EMAIL_DUPLICADO';
        }


        $sql = "UPDATE participantes SET nome_participante = :nome_participante, email = :email, telefone = :telefone WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':nome_participante' => $participante->getNomeParticipante(),
            ':email' => $participante->getEmail(),
            ':telefone' => $participante->getTelefone(),
            ':id' => $id_participante
        ])) {
            return 'ATUALIZADO';
        }

        return 'ERRO_ATUALIZAR';
    }

    public function excluirParticipante(int $id_participante): string
    {

        $sql = "DELETE FROM participantes WHERE id_participante = :id";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            ':id' => $id_participante
        ])) {

            if ($stmt->rowCount() > 0) {
                return 'EXCLUIDO';
            }

            return 'NAO_ENCONTRADO';
        }

        return 'ERRO_EXCLUIR';
    }
}
