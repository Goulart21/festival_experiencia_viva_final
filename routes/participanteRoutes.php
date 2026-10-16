<?php

function registrarRotasParticipantes(PDO $pdo): void
{
    require_once __DIR__ . '/../controller/ParticipanteController.php';

    $participanteService = new ParticipanteService($pdo);
    $participanteController = new ParticipanteController($participanteService);

    $metodo = $_SERVER['REQUEST_METHOD'];
    $caminho = $_GET['rota'] ?? '';

    if ($metodo === 'GET' && $caminho === 'participantes') {
        $participanteController->listarParticipantes();
        return;
    }

    if ($metodo === 'GET' && $caminho === 'participante_por_id') {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id <= 0) {

            header('Content-Type: application/json; charset=utf-8');
            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Informe um ID valido'
            ]);

            return;
        }

        $participanteController->buscarParticipantePorId($id);
        return;
    }

    if ($metodo === 'POST'  && $caminho === 'cadastrar_participante') {

        header('Content-Type: application/json; charset=utf-8');

        $dados = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($dados) || !isset($dados['nome_participante'], $dados['email'], $dados['telefone']) || !is_string($dados['nome_participante']) || !is_string($dados['email']) ||
            !is_string($dados['telefone']) || trim($dados['nome_participante']) === '' || trim($dados['email']) === '' || trim($dados['telefone']) === '' ||
            !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)
        ) {

            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Dados inválidos. Informe nome, email, válido e telefone'
            ]);

            return;
        }

        $participante = new Participante(
            trim($dados['nome_participante']),
            trim($dados['email']),
            trim($dados['telefone'])
        );

        $participanteController->cadastrarParticipante($participante);
        return;
    }


    if ($metodo === 'PUT' && $caminho === 'atualizar_participante') {

        header('Content-Type: application/json; charset=utf-8');

        // Recebe e valida o ID enviado pela URL
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id <= 0) {
            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Informe um ID válido'
            ]);

            return;
        }

        // Lê os dados enviados no Body do Postman
        $dados = json_decode(file_get_contents('php://input'), true);

        if (
            !is_array($dados) ||
            !isset(
                $dados['nome_participante'],
                $dados['email'],
                $dados['telefone']
            ) ||
            !is_string($dados['nome_participante']) ||
            !is_string($dados['email']) ||
            !is_string($dados['telefone']) ||
            trim($dados['nome_participante']) === '' ||
            trim($dados['email']) === '' ||
            trim($dados['telefone']) === '' ||
            !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)
        ) {
            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Dados inválidos. Informe nome, e-mail válido e telefone.'
            ]);

            return;
        }

        $participanteAtualizado = new Participante(
            trim($dados['nome_participante']),
            trim($dados['email']),
            trim($dados['telefone'])
        );

        $participanteController->atualizarParticipante(
            $id,
            $participanteAtualizado
        );

        return;
    }


    if ($metodo === 'DELETE' && $caminho === 'excluir_participante') {

        header('Content-Type: application/json; charset=utf-8');

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null || $id <= 0) {
            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Informe um ID válido'
            ]);

            return;
        }

        $participanteController->excluirParticipante($id);
        return;
    }



    header('Content-Type: application/json; charset=utf-8');
    http_response_code(404);

    echo json_encode([
        'mensagem' => 'Rota não encontrada'
    ]);
}
