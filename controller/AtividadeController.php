
<?php

require_once __DIR__ . '/../services/AtividadeService.php';

class AtividadeController
{

    private AtividadeService $atividadeService;

    public function __construct(AtividadeService $atividadeService)
    {
        $this->atividadeService = $atividadeService;
    }

    public function listarAtividades(): void
    {

        $atividades = $this->atividadeService->listarAtividades();

        header('Content-Type: application/json; charset=utf-8');

        http_response_code(200);

        echo json_encode($atividades, JSON_UNESCAPED_UNICODE);
        
    }

    public function buscarAtividadePorId(int $id_atividade): void
    {
        $resultado = $this->atividadeService->buscarAtividadePorId($id_atividade);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === null) {
            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Atividade não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }

        http_response_code(200);

        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    }

    public function cadastrarAtividade(Atividade $atividade): void
    {
        $resultado = $this->atividadeService->cadastrarAtividade($atividade);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'CAPACIDADE_INVALIDA') {

            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Capacidade inválida'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'CADASTRADA') {

            http_response_code(201);

            echo json_encode([
                'mensagem' => 'Atividade cadastrada com sucesso'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ERRO_CADASTRO') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro interno ao processar a solicitação'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }
    }

    public function atualizarAtividade(int $id_atividade, Atividade $atividade): void
    {
        $resultado = $this->atividadeService->atualizarAtividade(
            $id_atividade,
            $atividade
        );

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'CAPACIDADE_INVALIDA') {

            http_response_code(400);

            echo json_encode([
                'mensagem' => 'Capacidade inválida'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'NAO_ENCONTRADO') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Atividade não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'CAPACIDADE_MENOR_QUE_INSCRITOS') {

            http_response_code(409);

            echo json_encode([
                'mensagem' => 'A capacidade não pode ser menor que a quantidade de inscritos'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ATUALIZADA') {

            http_response_code(200);

            echo json_encode([
                'mensagem' => 'Atividade atualizada com sucesso'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ERRO_ATUALIZAR') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro interno ao processar a solicitação'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }
    }

    public function excluirAtividade(int $id_atividade): void
    {
        $resultado = $this->atividadeService->excluirAtividade($id_atividade);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'NAO_ENCONTRADO') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Atividade não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'POSSUI_INSCRICOES') {

            http_response_code(409);

            echo json_encode([
                'mensagem' => 'Atividade possui inscrições e não pode ser excluída'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'EXCLUIDO') {

            http_response_code(200);

            echo json_encode([
                'mensagem' => 'Atividade excluída com sucesso'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'ERRO_EXCLUIR') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro interno ao processar a solicitação'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }
    }
}
