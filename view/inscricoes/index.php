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

    <section class="card shadow-sm mb-4" aria-labelledby="tituloCadastro">

        <div class="card-body p-4">

            <h2 id="tituloCadastro" class="h5 fw-semibold mb-0">
                Cadastrar inscrição
            </h2>
        </div>

        <form method="post" class="p-4">

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="nome_participante" class="form-label">Nome participante</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecione o participante</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="nome_atividade" class="form-label">Nome atividade</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Selecione a atividade</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                </table>

                <tbody id="tabelaInscricoes">

                </tbody>
            </div>
        </div>
    </section>
</main>

<body>

</body>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>