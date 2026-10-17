

<?php

require_once __DIR__ . '/../services/ParticipanteService.php';

class ParticipanteController
{

    private ParticipanteService $participanteService;

    public function __construct(ParticipanteService $participanteService)
    {
        $this->participanteService = $participanteService;
    }


    public function listarParticipantes(): void
    {

        $participantes = $this->participanteService->listarParticipantes();

        //informa que a resposta é JSON e utiliza uft-8
        header('Content-Type: application/json; charset=utf-8');
        //informa que a requisição foi conclúida com sucesso
        http_response_code(200);
        //converte o array PHP em JSON e envia o conteudo na resposta HTTP
        echo json_encode($participantes, JSON_UNESCAPED_UNICODE);
    }

    public function buscarParticipantePorId(int $id_participante): void
    {

        $resultado = $this->participanteService->buscarParticipantePorId($id_participante);

        if ($resultado === null) {

            header('Content-Type: application/json; charset=utf-8');

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Atividade não encontrada'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }

        header('Content-Type: application/json; charset=utf-8');

        http_response_code(200);

        echo json_encode($resultado);
    }

    public function cadastrarParticipante(Participante $participante): void
    {

        $resultado = $this->participanteService->cadastrarParticipante($participante);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'EMAIL_DUPLICADO') {

            //Erro de conflito
            http_response_code(409);

            echo json_encode([
                'mensagem' => 'Email já cadastrado'
            ], JSON_UNESCAPED_UNICODE);
            return;
        } elseif ($resultado === 'ERRO_CADASTRAR') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro ao cadastrar'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'SUCESSO') {

            http_response_code(201);

            echo json_encode([
                'mensagem' => 'Participante cadastrado com sucesso'
            ], JSON_UNESCAPED_UNICODE);
        }
    }

    public function atualizarParticipante(int $id_participante, Participante $participante): void
    {

        $resultado = $this->participanteService->atualizarParticipante($id_participante, $participante);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'ATUALIZADO') {

            http_response_code(200);

            echo json_encode([
                'mensagem' => 'Participante atualizado'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'NAO_ENCONTRADO') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Participante não encontrado'
            ]);

            return;
        } elseif ($resultado === 'ERRO_ATUALIZAR') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro ao atualizar'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'EMAIL_DUPLICADO') {

            http_response_code(409);

            echo json_encode([
                'mensagem' => 'Email já cadastrado'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }
    }

    public function excluirParticipante(int $id_participante): void
    {

        $resultado = $this->participanteService->excluirParticipante($id_participante);

        header('Content-Type: application/json; charset=utf-8');

        if ($resultado === 'EXCLUIDO') {

            http_response_code(200);

            echo json_encode([
                'mensagem' => 'Participante excluido'
            ], JSON_UNESCAPED_UNICODE);

            return;
        } elseif ($resultado === 'NAO_ENCONTRADO') {

            http_response_code(404);

            echo json_encode([
                'mensagem' => 'Participante não encontrado'
            ]);

            return;
        } elseif ($resultado === 'ERRO_EXCLUIR') {

            http_response_code(500);

            echo json_encode([
                'mensagem' => 'Erro ao excluir participante'
            ], JSON_UNESCAPED_UNICODE);

            return;
        }
    }
}
