<?php

/** @var array $totais */
/** @var array $ocupacaoAtividades */
/** @var array $ultimasInscricoes */
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Festival Experiência Viva</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="css/tema.css" rel="stylesheet">
</head>

<body>

    <!-- Navegação -->
    <header>
        <nav
            class="navbar navbar-expand-lg navbar-dark p-4"
            style="background-color: var(--festival-verde);">
            <div class="container-fluid">


                <h1 class="navbar-brand fw-semibold mt-2">Experiência Viva</h1>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links da navegação -->
                <div
                    class="collapse navbar-collapse"
                    id="navbarNav">
                    <div class="navbar-nav ms-auto">

                        <a
                            class="nav-link"
                            href="?pagina=principal"
                            aria-current="page">
                            <i class="bi-house-door"></i>
                            Principal
                        </a>


                        <a
                            class="nav-link"
                            href="?pagina=dashboard"
                            aria-current="page">
                            <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                            Visão geral
                        </a>

                        <a
                            class="nav-link active"
                            href="?pagina=participantes">
                            <i class="bi bi-people me-1" aria-hidden="true"></i>
                            Participantes
                        </a>

                        <a
                            class="nav-link"
                            href="?pagina=atividades">
                            <i class="bi bi-calendar-event me-1" aria-hidden="true"></i>
                            Atividades
                        </a>

                        <a
                            class="nav-link"
                            href="?pagina=inscricoes">
                            <i class="bi bi-clipboard-check me-1" aria-hidden="true"></i>
                            Inscrições
                        </a>

                    </div>
                </div>

            </div>
        </nav>
    </header>

    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Apresentação -->
        <section class="mb-4">
            <p class="small fw-semibold mb-1"
                style="color: var(--festival-terracota);">
                Sistema de gerenciamento
            </p>

            <h1 class="h2 fw-semibold mb-2"
                style="color: var(--festival-folhagem);">
                Visão geral
            </h1>

            <p class="text-secondary mb-0">
                Organize participantes, atividades e inscrições em um só lugar.
            </p>
        </section>

        <!-- Cards -->
        <section class="mb-5">
            <h2 class="h4 fw-semibold">Gerenciamento do festival</h2>

            <p class="text-secondary">
                Selecione uma área para gerenciar seus dados.
            </p>

            <div class="row g-3">

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body p-3 p-md-4">
                            <div class="align-items-center gap-3 mb-3 p-3"
                                style="background-color: var(--festival-nevoa); color: var(--festival-verde);">
                                <i class="bi bi-people fs-3"></i>
                                <span class="fs-3 fw-semibold">
                                    <?= (int) $totais['total_participantes'] ?>
                                </span>
                            </div>

                            <h3 class="h5">Participantes</h3>
                            <p class="text-secondary">
                                Consulte e gerencie os cadastros.
                            </p>

                            <a href="?pagina=participantes"
                                class="btn btn-festival">
                                Gerenciar participantes
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body p-3 p-md-4">
                            <div class="align-items-center gap-3 mb-3 p-3"
                                style="background-color: var(--festival-nevoa); color: var(--festival-verde);">
                                <i class="bi bi-calendar-event fs-3"></i>
                                <span class="fs-3 fw-semibold">
                                    <?= (int) $totais['total_atividades'] ?>
                                </span>
                            </div>

                            <h3 class="h5">Atividades</h3>
                            <p class="text-secondary">
                                Consulte horários, locais e capacidades.
                            </p>

                            <a href="?pagina=atividades"
                                class="btn btn-festival">
                                Gerenciar atividades
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-body p-3 p-md-4">
                            <div class="align-items-center gap-3 mb-3 p-3"
                                style="background-color: var(--festival-nevoa); color: var(--festival-verde);">
                                <i class="bi bi-clipboard-check fs-3"></i>
                                <span class="fs-3 fw-semibold">
                                    <?= (int) $totais['inscricoes_ativas'] ?>
                                </span>
                            </div>

                            <h3 class="h5">Inscrições</h3>
                            <p class="text-secondary">
                                Acompanhe as inscrições nas atividades.
                            </p>

                            <a href="?pagina=inscricoes"
                                class="btn btn-festival">
                                Gerenciar inscrições
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Acompanhamento -->
        <section>
            <h2 class="h4 fw-semibold mb-3">Acompanhamento</h2>

            <div class="row g-3">

                <!-- Ocupação -->
                <div class="col-12 col-xl-7">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-3 p-md-4">

                            <h3 class="h5 mb-3">Ocupação das atividades</h3>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Atividade</th>
                                            <th>Data</th>
                                            <th style="min-width: 140px;">Ocupação</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (empty($ocupacaoAtividades)): ?>
                                            <tr>
                                                <td colspan="3" class="text-center py-3">
                                                    Nenhuma atividade cadastrada.
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($ocupacaoAtividades as $item): ?>
                                                <?php
                                                $percentual = (int) $item['percentual'];

                                                $corBarra = $percentual >= 100
                                                    ? 'bg-danger'
                                                    : ($percentual >= 80 ? 'bg-warning' : 'bg-success');
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?= htmlspecialchars(
                                                            (string) $item['nome_atividade'],
                                                            ENT_QUOTES,
                                                            'UTF-8'
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <?= date(
                                                            'd/m/Y',
                                                            strtotime((string) $item['data_atividade'])
                                                        ) ?>
                                                    </td>

                                                    <td>
                                                        <div class="progress"
                                                            role="progressbar"
                                                            aria-valuenow="<?= min(100, $percentual) ?>"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100"
                                                            style="height: 8px;">
                                                            <div class="progress-bar <?= $corBarra ?>"
                                                                style="width: <?= min(100, $percentual) ?>%;">
                                                            </div>
                                                        </div>

                                                        <span class="small text-secondary">
                                                            <?= (int) $item['inscritos'] ?> /
                                                            <?= (int) $item['capacidade'] ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Últimas inscrições -->
                <div class="col-12 col-xl-5">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-3 p-md-4">

                            <h3 class="h5 mb-3">Últimas inscrições</h3>

                            <?php if (empty($ultimasInscricoes)): ?>
                                <p class="text-secondary">
                                    Nenhuma inscrição cadastrada.
                                </p>
                            <?php else: ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($ultimasInscricoes as $item): ?>
                                        <li class="list-group-item px-0 d-flex justify-content-between align-items-start gap-2">

                                            <div class="text-break">
                                                <span class="fw-semibold">
                                                    <?= htmlspecialchars(
                                                        (string) $item['nome_participante'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </span>

                                                <div class="small text-secondary">
                                                    <?= htmlspecialchars(
                                                        (string) $item['nome_atividade'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>
                                                </div>
                                            </div>

                                            <span class="badge flex-shrink-0 <?= $item['status'] === 'ATIVA' ? 'text-bg-success' : 'text-bg-secondary' ?>">
                                                <?= htmlspecialchars(
                                                    (string) $item['status'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </span>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <a href="?pagina=inscricoes"
                                class="btn btn-outline-secondary btn-sm mt-3">
                                Ver todas
                            </a>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <footer class="border-top mt-4 py-3 text-center">
        <p class="small text-secondary mb-0">
            Festival Experiência Viva · Sistema de gerenciamento de inscrições
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>