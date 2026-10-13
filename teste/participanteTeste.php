
<?php


require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../services/ParticipanteService.php';


$participante = new Participante(
    'Pedro',
    'gaga@gmail.com',
    '3199200'
);

$participanteService = new ParticipanteService($pdo);

$resultado = $participanteService->cadastrarParticipante($participante);
echo $resultado;

$participantes = $participanteService->listarParticipante();
echo "<pre>";
print_r($participantes);
echo "</pre>";

$participanteId = $participanteService->buscarParticipantePorId(3);
echo "<pre>";
print_r($participanteId);
echo "</pre>";

$participanteAtualizado = new Participante(
    'Atualizado',
    'at@gmail.com',
    '3199999292'
);

$participanteService->atualizarParticipante(1,$participanteAtualizado);


