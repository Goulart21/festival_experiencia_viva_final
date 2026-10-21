<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes | Festival Experiência Viva</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="css/tema.css" rel="stylesheet">
</head>

<body>

    <header>

        <nav class="navbar navbar-expand-lg  navbar-dark p-4"
            style="background-color: var(--festival-verde);">
            <div class="container-fluid">

                <h1 class="navbar-brand fw-semibold mt2">Experiência Viva</h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterar Navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collpase navbar-collpase" id="navbarNav">

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
                            class="nav-link active"
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

    <main class="container-fluid p-5">

        <section class="mb-5">

            <p class="fw-semibold mb-2" style="color: var(--festival-terracota);">
                Gerenciamento do Festival
            </p>

            <h1 class="h2 fw-semibold mb-2" style="color: var(--festival-folhagem);">
                Atividades
            </h1>

            <p>Consulte as atividades cadastras no festival</p>
        </section>

        <?php $statusCadastro = $_GET['status'] ?? ''; ?>

        <?php if ($statusCadastro === 'cadastrada'): ?>
            <div class="alert alert-success" role="alert">
                Atividade cadastrada com sucesso!
            </div>

        <?php elseif ($statusCadastro === 'atualizado'): ?>
            <div class="alert alert-success" role="alert">
                Atividade atualizada com sucesso!
            </div>

        <?php elseif ($statusCadastro === 'erro_cadastro'): ?>
            <div class="alert alert-danger" role="alert">
                Não foi possível cadastrar a atividade.
            </div>

        <?php elseif ($statusCadastro === 'erro_atualizar'): ?>
            <div class="alert alert-danger" role="alert">
                Não foi possível atualizar a atividade.
            </div>

        <?php elseif ($statusCadastro === 'excluido'): ?>
            <div class="alert alert-danger" role="alert">
                Atividade excluida
            </div>

        <?php elseif ($statusCadastro === 'capacidade_invalida'): ?>
            <div class="alert alert-danger" role="alert">
                Capacidade Inv
            </div>

        <?php endif; ?>

        <?php $modoEdicao = $atividadeEdicao !== null; ?>

        <section class="card shadow-sm mb-4" aria-labelledby="tituloCadastro">

            <div class="card-body p-4">

                <h2 id="tituloCadastro" class="h5 fw-semibold mb-4">
                    Cadastrar atividade
                </h2>
            </div>


            <form method="POST" class="p-4" action="<?= $modoEdicao ? '?pagina=atividades&editar=' . (int) ($atividadeEdicao['id_atividade'] ?? '')
                                                        : '?pagina=atividades' ?>">

                <div class="row g-3">

                    <div class="col-md-3">
                        <label for="nome_atividade" class="form-label">Nome Atividade</label>
                        <input type="text" class="form-control" id="nome_atividade" name="nome_atividade" value="<?= htmlspecialchars((string) ($atividadeEdicao['nome_atividade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="<?= htmlspecialchars((string) ($atividadeEdicao['descricao'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="col-md-3 mt-4">
                        <label for="data_atividade">Data Atividade</label>
                        <input type="date" class="form-control" id="data_atividade" name="data_atividade" value="<?= htmlspecialchars((string) ($atividadeEdicao['data_atividade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hora_inicio">Hora Inicio</label>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="<?= htmlspecialchars((string) ($atividadeEdicao['hora_inicio'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hora_fim">Hora Termino</label>
                        <input type="time" class="form-control" id="hora_fim" name="hora_fim" value="<?= htmlspecialchars((string) ($atividadeEdicao['hora_fim'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label for="local_atividade" class="form-label">Local Atividade</label>
                        <input type="text" class="form-control" id="local_atividade" name="local_atividade" value="<?= htmlspecialchars((string) ($atividadeEdicao['local_atividade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label for="capacidade" class="form-label">Capacidade</label>
                        <input type="text" class="form-control" id="capacidade" name="capacidade" value="<?= htmlspecialchars((string) ($atividadeEdicao['capacidade'] ?? ''), ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>

                <div class="mt-4">

                    <button type="submit" class="btn btn-festival">
                        Cadastrar
                    </button>

                    <?php if ($modoEdicao): ?>
                        <a
                            href="?pagina=atividades"
                            class="btn btn-outline-secondary ms-2">
                            Cancelar
                        </a>
                    <?php endif; ?>

                </div>
            </form>
        </section>

        <section aria-label="Tabela de atvidades">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="ps-4">ID</th>
                                    <th scope="col">Atividade</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Hora Inicio</th>
                                    <th scope="col">Hora Termino</th>
                                    <th scope="col">Local</th>
                                    <th scope="col">Capacidade</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody id="tabelaAtividades">
                                <?php if (empty($atividades)): ?>

                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            Nenhuma atividade cadastrada
                                        </td>
                                    </tr>

                                <?php else: ?>

                                    <?php foreach ($atividades as $atividade): ?>

                                        <tr>
                                            <td class="ps-4">
                                                <?= (int) $atividade['id_atividade'] ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['nome_atividade'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['descricao'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['data_atividade'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['hora_inicio'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['hora_fim'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['local_atividade'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $atividade['capacidade'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <a href="?pagina=atividades&editar=<?= (int) $atividade['id_atividade'] ?>"
                                                    class="btn btn-outline-secondary btn-sm">
                                                    <i class="bi bi-pencil"> Editar</i>
                                                </a>

                                                <form
                                                    method="POST"
                                                    action="?pagina=atividades&acao=excluir&id=<?= (int) $atividade['id_atividade'] ?>"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Tem certeza de que deseja excluir esta atividade?');">

                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-trash me-1" aria-hidden="true"></i>
                                                        Excluir
                                                    </button>

                                                </form>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>

                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>