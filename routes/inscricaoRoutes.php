<?php

function registrarRotasInscricoes(PDO $pdo): void
{
    require_once __DIR__ . '/../controller/InscricaoController.php';

    $inscricaoService = new InscricaoService($pdo);
    $inscricaoController = new InscricaoController($inscricaoService);

    $metodo = $_SERVER['REQUEST_METHOD'];
    $caminho = $_GET['rota'] ?? '';


    if ($metodo === 'GET' && $caminho === 'inscricoes') {
        $inscricaoController->listarInscricoes();
        return;
    }
}