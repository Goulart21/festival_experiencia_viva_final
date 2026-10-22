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
    'participantes' => __DIR__ . '/../view/participantes/index.php',
    'atividades' => __DIR__ . '/../view/atividades/index.php',
    'inscricoes' => __DIR__ . '/../view/inscricoes/index.php',
    'principal' => __DIR__ . '/../view/principal.php'
];

if (
    isset($paginasPermitidas[$pagina]) &&
    is_file($paginasPermitidas[$pagina])
) {

    if ($pagina === 'dashboard') {

        require_once __DIR__ . '/../services/DashboardService.php';

        $dashboardService = new DashboardService($pdo);

        $totais = $dashboardService->obterTotais();
        $ocupacaoAtividades = $dashboardService->listarOcupacaoAtividades();
        $ultimasInscricoes = $dashboardService->listarUltimasInscricoes();
    }

    if ($pagina === 'participantes') {

        require_once __DIR__ . '/../services/ParticipanteService.php';

        $participanteService = new ParticipanteService($pdo);



        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            ($_GET['acao'] ?? '') === 'excluir'
        ) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null || $id <= 0) {
                header('Location: ?pagina=participantes&status=dados_invalidos');
                exit;
            }

            try {
                $resultado = $participanteService->excluirParticipante($id);

                if ($resultado === 'EXCLUIDO') {
                    $status = 'excluido';
                } elseif ($resultado === 'NAO_ENCONTRADO') {
                    $status = 'participante_nao_encontrado';
                } else {
                    $status = 'erro_excluir';
                }
            } catch (PDOException $e) {
                $status = 'erro_excluir';
            }

            header('Location: ?pagina=participantes&status=' . $status);
            exit;
        }


        $participanteEdicao = null;

        if (isset($_GET['editar'])) {

            $id = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);

            if ($id === false || $id === null || $id <= 0) {
                header('Location: ?pagina=participantes&status=dados_invalidos');
                exit;
            }

            $participanteEdicao =
                $participanteService->buscarParticipantePorId($id);

            if ($participanteEdicao === null) {
                header('Location: ?pagina=participantes&status=participante_nao_encontrado');
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = $_POST['nome_participante'] ?? null;
            $email = $_POST['email'] ?? null;
            $telefone = $_POST['telefone'] ?? null;

            $estaEditando = isset($_GET['editar']);

            // Valida os dados recebidos.
            if (
                !is_string($nome) ||
                !is_string($email) ||
                !is_string($telefone) ||
                trim($nome) === '' ||
                trim($email) === '' ||
                trim($telefone) === '' ||
                !filter_var(trim($email), FILTER_VALIDATE_EMAIL)
            ) {
                $destino = '?pagina=participantes';

                if ($estaEditando) {
                    $destino .= '&editar=' . (int) $_GET['editar'];
                }

                header('Location: ' . $destino . '&status=dados_invalidos');
                exit;
            }

            $participante = new Participante(
                trim($nome),
                trim($email),
                trim($telefone)
            );

            try {

                if ($estaEditando) {

                    $id = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);

                    if ($id === false || $id === null || $id <= 0) {
                        header('Location: ?pagina=participantes&status=dados_invalidos');
                        exit;
                    }

                    $resultado = $participanteService->atualizarParticipante(
                        $id,
                        $participante
                    );

                    if ($resultado === 'ATUALIZADO') {

                        header('Location: ?pagina=participantes&status=atualizado');
                        exit;
                    } elseif ($resultado === 'EMAIL_DUPLICADO') {

                        header(
                            'Location: ?pagina=participantes&editar='
                                . $id
                                . '&status=email_duplicado'
                        );
                        exit;
                    } elseif ($resultado === 'NAO_ENCONTRADO') {

                        header('Location: ?pagina=participantes&status=participante_nao_encontrado');
                        exit;
                    } else {

                        header(
                            'Location: ?pagina=participantes&editar='
                                . $id
                                . '&status=erro'
                        );
                        exit;
                    }
                } else {

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

                    header('Location: ?pagina=participantes&status=' . $status);
                    exit;
                }
            } catch (PDOException $e) {

                header('Location: ?pagina=participantes&status=erro');
                exit;
            }
        }
        // Busca os participantes para renderizar a tabela.
        $participantes = $participanteService->listarParticipantes();
    }

    if ($pagina === 'atividades') {

        require __DIR__ . '/../services/AtividadeService.php';

        $atividadeService = new AtividadeService($pdo);

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            ($_GET['acao'] ?? '') === 'excluir'
        ) {

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null || $id <= 0) {
                header('Location: ?pagina=atividades&status=dados_invalidos');
                exit;
            }

            try {

                $resultado = $atividadeService->excluirAtividade($id);

                if ($resultado === 'EXCLUIDO') {
                    $status = 'excluido';
                } elseif ($resultado === 'NAO_ENCONTRADO') {
                    $status = 'atividade_nao_encontrada';
                } elseif ($resultado === 'POSSUI_INCRICOES') {
                    $status = 'possui_inscricoes';
                } elseif ($resultado === 'ERRO_EXCLUIR') {
                    $status = 'erro_excluir';
                }
            } catch (PDOException $e) {
                $status = 'erro_excluir';
            }

            header('Location: ?pagina=atividades&status=' . $status);
            exit;
        }

        $atividadeEdicao = null;

        if (isset($_GET['editar'])) {

            $id = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);

            if ($id === false || $id === null || $id <= 0) {

                header('Location: ?pagina=atividades&status=dados_invalidos');
                exit;
            }

            $atividadeEdicao = $atividadeService->buscarAtividadePorId($id);

            if ($atividadeEdicao === null) {
                header('Location: ?pagina=atividades&status=atividade_nao_encontrada');
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome_atividade = $_POST['nome_atividade']  ?? null;
            $descricao = $_POST['descricao']  ?? null;
            $data_atividade = $_POST['data_atividade']  ?? null;
            $hora_inicio = $_POST['hora_inicio']  ?? null;
            $hora_fim = $_POST['hora_fim']  ?? null;
            $local_atividade = $_POST['local_atividade']  ?? null;
            $capacidade = $_POST['capacidade']  ?? null;

            $estaEditando  = isset($_GET['editar']);

            if (
                is_string($capacidade) &&
                filter_var($capacidade, FILTER_VALIDATE_INT) !== false &&
                (int) $capacidade <= 0
            ) {
                header('Location: ?pagina=atividades&status=capacidade_invalida');
                exit;
            }

            if (
                !is_string($nome_atividade) ||
                !is_string($descricao) ||
                !is_string($data_atividade) ||
                !is_string($hora_inicio) ||
                !is_string($hora_fim) ||
                !is_string($local_atividade) ||
                !is_string($capacidade) ||
                trim($nome_atividade) === '' ||
                trim($descricao) === '' ||
                trim($data_atividade) === '' ||
                trim($hora_inicio) === '' ||
                trim($hora_fim) === '' ||
                trim($local_atividade) === '' ||
                filter_var($capacidade, FILTER_VALIDATE_INT) === false ||
                (int) $capacidade <= 0
            ) {
                $destino = '?pagina=atividades';

                if ($estaEditando) {
                    $destino .= '&editar=' . (int) $_GET['editar'];
                }

                header('Location: ' . $destino . '&status=dados_invalidos');
                exit;
            }

            $atividade = new Atividade(
                trim($nome_atividade),
                trim($descricao),
                trim($data_atividade),
                trim($hora_inicio),
                trim($hora_fim),
                trim($local_atividade),
                trim($capacidade)
            );


            if ($estaEditando) {

                $id = filter_input(INPUT_GET, 'editar', FILTER_VALIDATE_INT);

                if ($id === false || $id === null || $id <= 0) {
                    header('Location: ?pagina=atividades&status=dados_invalidos');
                    exit;
                }

                $resultado = $atividadeService->atualizarAtividade($id, $atividade);

                if ($resultado === 'ATUALIZADA') {

                    header('Location: ?pagina=atividades&status=atualizado');
                    exit;
                } elseif ($resultado === 'CAPACIDADE_INVALIDA') {

                    header('Location: ?pagina=atividades&status=capacidade_invalida');
                    exit;
                } elseif ($resultado === 'NAO_ENCONTRADO') {

                    header('Location: ?pagina=atividades&status=nao_encontrado');
                    exit;
                } elseif ($resultado === 'CAPACIDADE_MENOR_QUE_INSCRITOS') {

                    header('Location: ?pagina=atividades&status=capacidade_menor_inscritos');
                    exit;
                } elseif ($resultado === 'ERRO_ATUALIZAR') {

                    header('Location: ?pagina=atividades&status=erro_atualizar');
                    exit;
                } else {

                    header('Location: ?pagina=atividades&status=erro_atualizar');
                    exit;
                }
            } else {
                $resultado = $atividadeService->cadastrarAtividade($atividade);

                if ($resultado === 'CADASTRADA') {
                    header('Location: ?pagina=atividades&status=cadastrada');
                    exit;
                } elseif ($resultado === 'CAPACIDADE_INVALIDA') {
                    header('Location: ?pagina=atividades&status=capacidade_invalida');
                    exit;
                } else {
                    header('Location: ?pagina=atividades&status=erro_cadastro');
                    exit;
                }
            }
        }

        $atividades = $atividadeService->listarAtividades();
    }

    if ($pagina === 'inscricoes') {

        require_once __DIR__ . '/../services/InscricaoService.php';
        require_once __DIR__ . '/../services/ParticipanteService.php';
        require_once __DIR__ . '/../services/AtividadeService.php';

        $inscricaoService = new InscricaoService($pdo);
        $atividadeService = new AtividadeService($pdo);
        $participanteService = new ParticipanteService($pdo);

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            ($_GET['acao'] ?? '') === 'cancelar'
        ) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null || $id <= 0) {
                header('Location: ?pagina=inscricoes&status=dados_invalidos');
                exit;
            }

            $resultado = $inscricaoService->cancelarInscricao($id);

            if ($resultado === 'CANCELADA') {
                $status = 'cancelada';
            } elseif ($resultado === 'NAO_ENCONTRADO') {
                $status = 'inscricao_nao_encontrada';
            } elseif ($resultado === 'JA_CANCELADA') {
                $status = 'ja_cancelada';
            } else {
                $status = 'erro_cancelar';
            }

            header('Location: ?pagina=inscricoes&status=' . $status);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_participante = filter_input(INPUT_POST, 'nome_participante', FILTER_VALIDATE_INT);
            $id_atividade = filter_input(INPUT_POST, 'nome_atividade', FILTER_VALIDATE_INT);

            if (
                $id_participante === false || $id_participante === null || $id_participante <= 0 ||
                $id_atividade === false || $id_atividade === null || $id_atividade <= 0
            ) {
                header('Location: ?pagina=inscricoes&status=dados_invalidos');
                exit;
            }

            $inscricao = new Inscricao($id_participante, $id_atividade);

            $resultado = $inscricaoService->cadastrarInscricao($inscricao);

            if ($resultado === 'CADASTRADA') {
                $status = 'cadastrada';
            } elseif ($resultado === 'REATIVADA') {
                $status = 'reativada';
            } elseif ($resultado === 'INSCRICAO_DUPLICADA') {
                $status = 'inscricao_duplicada';
            } elseif ($resultado === 'ATIVIDADE_SEM_VAGAS') {
                $status = 'atividade_sem_vagas';
            } elseif ($resultado === 'PARTICIPANTE_NAO_ENCONTRADO') {
                $status = 'participante_nao_encontrado';
            } elseif ($resultado === 'ATIVIDADE_NAO_ENCONTRADA') {
                $status = 'atividade_nao_encontrada';
            } else {
                $status = 'erro_cadastro';
            }

            header('Location: ?pagina=inscricoes&status=' . $status);
            exit;
        }

        $inscricoes = $inscricaoService->listarInscricoes();
        $participantes = $participanteService->listarParticipantes();
        $atividades = $atividadeService->listarAtividades();
    }

    require $paginasPermitidas[$pagina];
} else {

    http_response_code(404);

    echo 'Página não encontrada.';
}
