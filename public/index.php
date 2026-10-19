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
    'dashboard' => __DIR__ . '/../view/layouts/dashboard.php'
];

if (
    isset($paginasPermitidas[$pagina]) &&
    is_file($paginasPermitidas[$pagina])
) {

    require $paginasPermitidas[$pagina];

} else {

    http_response_code(404);

    echo 'Página não encontrada.';
}