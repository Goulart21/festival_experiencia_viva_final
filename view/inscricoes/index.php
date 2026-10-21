<?php

/** @var array $participantes */
/** @var array $atividades */
/** @var array $inscricoes */
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="css/tema.css" rel="stylesheet">
</head>


<header>

    <nav class="navbar navbar-expand-lg navbar-dark p-4" style="background-color: var(--festival-verde);">
        <div class="container-fluid">

            <h1 class="navbar-brand fw-semibold">Experiência Viva</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Abrir Navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <div class="navbar-nav ms-auto">
                    <a
                        class="nav-link"
                        href="?pagina=dashboard">
                        <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                        Visão geral
                    </a>

                    <a
                        class="nav-link"
                        href="?pagina=participantes"
                        aria-current="page">
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
                        class="nav-link active"
                        href="?pagina=inscricoes">
                        <i class="bi bi-clipboard-check me-1" aria-hidden="true"></i>
                        Inscrições
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="container-fluid p-5">

    <section>

        <p class="fw-semibold mb-2" style="color: var(--festival-terracota);">
            Gerenciamento do Festival
        </p>

        <h1 class="h2 fw-semibold mb-2" style="color: var(--festival-folhagem);">
            Inscrições
        </h1>

        <p>Consulte inscrições cadastras no festival</p>
    </section>

    <?php $statusCadastro = $_GET['status'] ?? ''; ?>

    <?php if ($statusCadastro === 'cadastrada'): ?>
        <div class="alert alert-success" role="alert">
            Inscrição cadastrada com sucesso!
        </div>

    <?php elseif ($statusCadastro === 'reativada'): ?>
        <div class="alert alert-success" role="alert">
            Inscrição reativada com sucesso!
        </div>

    <?php elseif ($statusCadastro === 'cancelada'): ?>
        <div class="alert alert-danger" role="alert">
            Inscrição cancelada
        </div>

    <?php elseif ($statusCadastro === 'inscricao_duplicada'): ?>
        <div class="alert alert-danger" role="alert">
            Este participante já está inscrito nesta atividade.
        </div>

    <?php elseif ($statusCadastro === 'atividade_sem_vagas'): ?>
        <div class="alert alert-danger" role="alert">
            Esta atividade não possui mais vagas.
        </div>

    <?php elseif ($statusCadastro === 'participante_nao_encontrado'): ?>
        <div class="alert alert-danger" role="alert">
            Participante não encontrado.
        </div>

    <?php elseif ($statusCadastro === 'atividade_nao_encontrada'): ?>
        <div class="alert alert-danger" role="alert">
            Atividade não encontrada.
        </div>

    <?php elseif ($statusCadastro === 'dados_invalidos'): ?>
        <div class="alert alert-danger" role="alert">
            Dados inválidos. Selecione o participante e a atividade.
        </div>

    <?php elseif ($statusCadastro === 'erro_cadastro'): ?>
        <div class="alert alert-danger" role="alert">
            Não foi possível cadastrar a inscrição.
        </div>

    <?php elseif ($statusCadastro === 'inscricao_nao_encontrada'): ?>
        <div class="alert alert-danger" role="alert">
            Inscrição não encontrada.
        </div>

    <?php elseif ($statusCadastro === 'ja_cancelada'): ?>
        <div class="alert alert-danger" role="alert">
            Esta inscrição já está cancelada.
        </div>

    <?php elseif ($statusCadastro === 'erro_cancelar'): ?>
        <div class="alert alert-danger" role="alert">
            Não foi possível cancelar a inscrição.
        </div>

    <?php endif; ?>
    <section class="card shadow-sm mb-4" aria-labelledby="tituloCadastro">

        <div class="card-body p-4">

            <h2 id="tituloCadastro" class="h5 fw-semibold mb-0">
                Cadastrar inscrição
            </h2>
        </div>

        <form method="POST" class="p-4">

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="nome_participante" class="form-label">Nome participante</label>
                    <select name="nome_participante" id="nome_participante" class="form-select" required>
                        <option value="">Selecione o participante</option>

                        <?php foreach ($participantes as $participante): ?>
                            <option value="<?= (int) $participante['id_participante'] ?>">
                                <?= htmlspecialchars(
                                    (string) $participante['nome_participante'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>


                </div>


                <div class="col-md-6">
                    <label for="nome_atividade" class="form-label">Nome atividade</label>

                    <select name="nome_atividade" id="nome_atividade" class="form-select" required>
                        <option value="">Selecione a atividade</option>

                        <?php foreach ($atividades as $atividade): ?>
                            <option value="<?= (int) $atividade['id_atividade'] ?>">
                                <?= htmlspecialchars(
                                    (string) $atividade['nome_atividade'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>

            <div class="mt-4">

                <button type="submit" class="btn btn-festival">
                    Cadastrar
                </button>
            </div>
        </form>
    </section>

    <section aria-label="Tabela de atividades">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead class="table-ligth">
                            <tr>
                                <th scope="col" class="ps-4">ID</th>
                                <th scope="col" class="ps-4">Nome Participante</th>
                                <th scope="col" class="ps-4">Nome Atividade</th>
                                <th scope="col" class="ps-4">Status</th>
                                <th scope="col" class="ps-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaInscricoes">

                            <?php if (empty($inscricoes)): ?>

                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Nenhuma inscrição cadastrada.
                                    </td>
                                </tr>

                            <?php else: ?>

                                <?php foreach ($inscricoes as $inscricao): ?>

                                    <tr>
                                        <td class="ps-4">
                                            <?= (int) $inscricao['id_inscricao'] ?>
                                        </td>

                                        <td class="ps-4">
                                            <?= htmlspecialchars(
                                                (string) $inscricao['nome_participante'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td class="ps-4">
                                            <?= htmlspecialchars(
                                                (string) $inscricao['nome_atividade'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td class="ps-4">
                                            <?= htmlspecialchars(
                                                (string) $inscricao['status'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </td>

                                        <td class="ps-4">
                                            <?php if ($inscricao['status'] === 'ATIVA'): ?>
                                                <form
                                                    method="POST"
                                                    action="?pagina=inscricoes&acao=cancelar&id=<?= (int) $inscricao['id_inscricao'] ?>"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Tem certeza de que deseja cancelar esta inscrição?');">

                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-x-circle me-1" aria-hidden="true"></i>
                                                        Cancelar
                                                    </button>

                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>
                </div>
                </table>
            </div>
        </div>
    </section>
</main>

<body>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>