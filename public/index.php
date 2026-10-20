<?php

require_once __DIR__ . '/../config/config.php';

$rota = $_GET['rota'] ?? null;


if ($rota !== null) {

    $rotasParticipantes = [
        'participantes',
        'participante_por_id',
        'cadastrar_participante',
        'atualizar_participante',
        'excluir_participante'
    ];

    $rotasAtividades = [
        'atividades',
        'atividade_por_id',
        'cadastrar_atividade',
        'atualizar_atividade',
        'excluir_atividade'
    ];

    $rotasInscricoes = [
        'inscricoes',
        'inscricao_por_id',
        'cadastrar_inscricao',
        'cancelar_inscricao'
    ];

    if (in_array($rota, $rotasParticipantes, true)) {

        require_once __DIR__ . '/../routes/participanteRoutes.php';

        registrarRotasParticipantes($pdo);
    } elseif (in_array($rota, $rotasAtividades, true)) {

        require_once __DIR__ . '/../routes/atividadeRoutes.php';

        registrarRotasAtividades($pdo);
    } elseif (in_array($rota, $rotasInscricoes, true)) {

        require_once __DIR__ . '/../routes/inscricaoRoutes.php';

        registrarRotasInscricoes($pdo);
    } else {

        header('Content-Type: application/json; charset=utf-8');

        http_response_code(404);

        echo json_encode([
            'mensagem' => 'Rota não encontrada'
        ], JSON_UNESCAPED_UNICODE);
    }

    exit;
}

$pagina = $_GET['pagina'] ?? 'dashboard';

$paginasPermitidas = [
    'dashboard' => __DIR__ . '/../view/dashboard.php',
    'participantes' => __DIR__ . '/../view/participantes/index.php'
];

if (
    isset($paginasPermitidas[$pagina]) &&
    is_file($paginasPermitidas[$pagina])
) {


    if ($pagina === 'participantes') {

        require_once __DIR__ . '/../services/ParticipanteService.php';

        $participanteService = new ParticipanteService($pdo);

        // Processa o envio do formulário.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = $_POST['nome_participante'] ?? null;
            $email = $_POST['email'] ?? null;
            $telefone = $_POST['telefone'] ?? null;

            // Valida os campos recebidos.
            if (
                !is_string($nome) ||
                !is_string($email) ||
                !is_string($telefone) ||
                trim($nome) === '' ||
                trim($email) === '' ||
                trim($telefone) === '' ||
                !filter_var(trim($email), FILTER_VALIDATE_EMAIL)
            ) {
                header('Location: ?pagina=participantes&status=dados_invalidos');
                exit;
            }

            $participante = new Participante(
                trim($nome),
                trim($email),
                trim($telefone)
            );

            try {
                $resultado = $participanteService->cadastrarParticipante(
                    $participante
                );

                if ($resultado === 'SUCESSO') {
                    $status = 'sucesso';
                } elseif ($resultado === 'EMAIL_DUPLICADO') {
                    $status = 'email_duplicado';
                } else {
                    $status = 'erro';
                }
            } catch (PDOException $e) {
                $status = 'erro';
            }

            // Redireciona após o processamento do formulário.
            header('Location: ?pagina=participantes&status=' . $status);
            exit;
        }

        // Busca os participantes para renderizar a tabela.
        $participantes = $participanteService->listarParticipantes();
    }


    // Carrega a página solicitada
    require $paginasPermitidas[$pagina];
} else {

    http_response_code(404);

    echo 'Página não encontrada.';
}
