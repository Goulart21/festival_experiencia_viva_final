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

        <section class="card shadow-sm mb-4" aria-labelledby="tituloCadastro">

            <div class="card-body p-4">

                <h2 id="tituloCadastro" class="h5 fw-semibold mb-4">
                    Cadastrar atividade
                </h2>
            </div>


            <form action="POST" class="p-4">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label for="nome_atividade" class="form-label">Nome Atividade</label>
                        <input type="text" class="form-control" id="nome_atividade" name="nome_participante" required>
                    </div>

                    <div class="col-md-4">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" required>
                    </div>

                    <div class="col-md-4 mt-4">
                        <label for="data_atividade">Data Atividade</label>
                        <input type="date" class="form-control" id="data_atividade" name="data_atividade" required>
                    </div>

                    <div class="col-md-4">
                        <label for="hora_inicio">Hora Inicio</label>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                    </div>

                    <div class="col-md-4">
                        <label for="hora_fim">Hora Termino</label>
                        <input type="time" class="form-control" id="hora_fim" name="hora_fim" required>
                    </div>

                    <div class="col-md-4">
                        <label for="local_atividade" class="form-label">Local Atividade</label>
                        <input type="text" class="form-control" id="local_atividade" name="local_atividade" required>
                    </div>
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

                            <tbody>

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