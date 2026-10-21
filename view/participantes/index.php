<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

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
        <nav
            class="navbar navbar-expand-lg navbar-dark p-4"
            style="background-color: var(--festival-verde);">
            <div class="container-fluid">

                <h1 class="navbar-brand fw-semibold mt-2">Experiência Viva</h1>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div
                    class="collapse navbar-collapse"
                    id="navbarNav">
                    <div class="navbar-nav ms-auto">

                        <a
                            class="nav-link"
                            href="?pagina=dashboard">
                            <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                            Visão geral
                        </a>

                        <a
                            class="nav-link active"
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

    <!-- Conteúdo principal -->
    <main class="container-fluid p-5">

        <section class="mb-5">

            <p
                class="fw-semibold mb-2"
                style="color: var(--festival-terracota);">
                Gerenciamento do festival
            </p>

            <h1
                class="h2 fw-semibold mb-2"
                style="color: var(--festival-folhagem);">
                Participantes
            </h1>

            <p>
                Consulte os participantes cadastrados no festival.
            </p>


        </section>


        <!-- Mensagens do cadastro -->
        <?php $statusCadastro = $_GET['status'] ?? ''; ?>

        <?php if ($statusCadastro === 'sucesso'): ?>

            <div class="alert alert-success" role="alert">
                Participante cadastrado com sucesso!
            </div>

        <?php elseif ($statusCadastro === 'email_duplicado'): ?>

            <div class="alert alert-warning" role="alert">
                Este e-mail já está cadastrado.
            </div>

        <?php elseif ($statusCadastro === 'dados_invalidos'): ?>

            <div class="alert alert-danger" role="alert">
                Preencha todos os campos corretamente.
            </div>

        <?php elseif ($statusCadastro === 'erro'): ?>

            <div class="alert alert-danger" role="alert">
                Não foi possível cadastrar o participante.
            </div>

        <?php elseif ($statusCadastro === 'atualizado'): ?>

            <div class="alert alert-success" role="alert">
                Participante atualizado com sucesso!
            </div>

        <?php endif; ?>



        <?php
        $modoEdicao = $participanteEdicao !== null;
        ?>

        <!-- Formulário de cadastro ou edição -->
        <section class="card shadow-sm mb-4" aria-labelledby="tituloCadastro">

            <div class="card-body p-4">

                <h2 id="tituloCadastro" class="h5 fw-semibold mb-4">
                    Cadastrar Participantes
                </h2>

                <form
                    method="POST"
                    action="<?= $modoEdicao
                                ? '?pagina=participantes&editar=' . (int) ($participanteEdicao['id_participante'] ?? '')
                                : '?pagina=participantes' ?>">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label for="nome_participante" class="form-label">
                                Nome completo
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nome_participante"
                                name="nome_participante"
                                value="<?= htmlspecialchars(
                                            (string) ($participanteEdicao['nome_participante'] ?? ''),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="email" class="form-label">
                                E-mail
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                value="<?= htmlspecialchars(
                                            (string) ($participanteEdicao['email'] ?? ''),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="telefone" class="form-label">
                                Telefone
                            </label>

                            <input
                                type="tel"
                                class="form-control"
                                id="telefone"
                                name="telefone"
                                value="<?= htmlspecialchars(
                                            (string) ($participanteEdicao['telefone'] ?? ''),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>"
                                required>
                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-festival">
                            Cadastrar
                        </button>

                        <?php if ($modoEdicao): ?>
                            <a
                                href="?pagina=participantes"
                                class="btn btn-outline-secondary ms-2">
                                Cancelar
                            </a>
                        <?php endif; ?>

                    </div>

                </form>

            </div>

        </section>



        <section aria-label="Lista de participantes">

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="ps-4">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>


                            <tbody id="tabelaParticipantes">

                                <?php if (empty($participantes)): ?>

                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            Nenhum participante cadastrado.
                                        </td>
                                    </tr>

                                <?php else: ?>

                                    <?php foreach ($participantes as $participante): ?>

                                        <tr>
                                            <td class="ps-4">
                                                <?= htmlspecialchars(
                                                    (string) $participante['id_participante'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    (string) $participante['nome_participante'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    (string) $participante['email'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    (string) $participante['telefone'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </td>

                                            <td>
                                                <a
                                                    href="?pagina=participantes&editar=<?= (int) $participante['id_participante'] ?>"
                                                    class="btn btn-outline-secondary btn-sm">
                                                    <i class="bi bi-pencil"> Editar</i>

                                                </a>

                                                <form
                                                    method="POST"
                                                    action="?pagina=participantes&acao=excluir&id=<?= (int) $participante['id_participante'] ?>"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Tem certeza de que deseja excluir este participante?');">

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

            <div
                id="mensagemParticipantes"
                class="alert alert-danger mt-3 d-none"
                role="alert"></div>

        </section>

    </main>

    <footer class="border-top mt-5 pt-4 text-center">

        <p class="small text-secondary">
            Festival Experiência Viva
            <span class="p-1">·</span>
            Sistema de gerenciamento de inscrições
        </p>

    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>