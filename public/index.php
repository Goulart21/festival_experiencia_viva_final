
<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../routes/participanteRoutes.php';
require_once __DIR__ . '/../routes/atividadeRoutes.php';

$rota = $_GET['rota'] ?? '';

if (str_contains($rota, 'participante')) {

    registrarRotasParticipantes($pdo);
} else {

    registrarRotasAtividades($pdo);
}
