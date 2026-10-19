
<?php

require_once __DIR__ . '/../services/InscricaoService.php';

class InscricaoController
{

    private InscricaoService $inscricaoService;

    public function __construct(InscricaoService $inscricaoService)
    {
        $this->inscricaoService = $inscricaoService;
    }

    public function listarInscricoes(): void
    {

        $inscricoes = $this->inscricaoService->listarInscricoes();

        header('Content-Type: application/json; charset=utf-8');

        http_response_code(200);
        echo json_encode($inscricoes, JSON_UNESCAPED_UNICODE);
    }


    public function buscarInscricaoPorId(int $id_inscricao): void
    {
        $resultado = $this->inscricaoService->buscarInscricaoPorId($id_inscricao);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === null) {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Inscrição não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }

        http_response_code(200);

        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    }
    public function cadastrarInscricao(Inscricao $inscricao): void
    {
        $resultado = $this->inscricaoService->cadastrarInscricao($inscricao);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'PARTICIPANTE_NAO_ENCONTRADO') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Participante não encontrado'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ATIVIDADE_NAO_ENCONTRADA') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Atividade não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'INSCRICAO_DUPLICADA') {

            http_response_code(409);

            echo json_encode([
                'mensagem' => 'Participante já inscrito nessa atividade'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ATIVIDADE_SEM_VAGAS') {

            http_response_code(409);

            echo json_encode([
                'mensagem' => 'Atividade sem vagas disponíveis'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'REATIVADA') {

            http_response_code(200);

            echo json_encode([
                'mensagem' => 'Inscrição reativada com sucesso'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'CADASTRADA') {

            http_response_code(201);

            echo json_encode([
                'mensagem' => 'Inscrição cadastrada com sucesso'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ERRO_CADASTRO') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro ao cadastrar inscrição'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }

        http_response_code(500);

        echo json_encode([
            'mensagem' => 'Erro interno ao processar a inscrição'
        ], JSON_UNESCAPED_UNICODE);
    }

    public function cancelarInscricao(int $id_inscricao): void
    {

        $resultado = $this->inscricaoService->cancelarInscricao($id_inscricao);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'NAO_ENCONTRADO') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Inscricao não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'JA_CANCELADA') {

            http_response_code(409);

            echo json_encode([
                'mensagem' => 'Inscrição já cancelada'
            ], JSON_UNESCAPED_UNICODE);
            return;
        } elseif ($resultado === 'CANCELADA') {

            http_response_code(200);

            echo json_encode([
                'mensagem' => 'Inscrição cancelada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ERRO_CANCELAR') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro ao cancelar'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }

        http_response_code(500);

        echo json_encode([
            'mensagem' => 'Erro interno ao processar a inscrição'
        ], JSON_UNESCAPED_UNICODE);
    }
}
