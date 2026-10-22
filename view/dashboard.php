<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">
    <title> Festival Experiência Viva</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS do projeto -->
    <link href="css/tema.css" rel="stylesheet">
</head>

<body>

    <!-- Navegação principal -->

    <header>
        <nav
            class="navbar navbar-expand-lg navbar-dark p-4"
            style="background-color: var(--festival-verde);">
            <div class="container-fluid">

                <!-- Identidade visual -->
                <h1 class="navbar-brand fw-semibold mt-2">Experiência Viva</h1>
                <!-- Botão do menu responsivo -->
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
                            class="nav-link active"
                            href="?pagina=dashboard"
                            aria-current="page">
                            <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                            Visão geral
                        </a>

                        <a
                            class="nav-link"
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


    <!-- Conteúdo principal -->
    <main class="container-fluid p-5">

        <!-- Apresentação -->
        <section class="mb-5">

            <p
                class="fw-semibold small mb-2"
                style="color: var(--festival-terracota);">
                Sistema de gerenciamento
            </p>

            <h1
                class="fw-semibold mb-3"
                style="color: var(--festival-folhagem);">
                Visão geral
            </h1>

            <p class="text-secondary">
                Organize os participantes, as atividades e as inscrições
                do Festival Experiência Viva em um só lugar.
            </p>

        </section>

        <!-- Módulos do sistema -->
        <section aria-labelledby="tituloModulos">

            <div class="mb-4">
                <h2 class="h4 fw-semibold" id="tituloModulos">
                    Gerenciamento do festival
                </h2>

                <p class="text-secondary mb-0">
                    Selecione uma área para conhecer suas funcionalidades.
                </p>
            </div>

            <div class="row g-4">

                <!-- Card de participantes -->
                <div class="col-12 col-md-6 col-xl-4">

                    <div class="card h-100">

                        <div class="card-body p-4">

                            <div
                                class="rounded-3 p-3 mb-3"
                                style="background-color: var(--festival-nevoa); color: var(--festival-verde);">
                                <i
                                    class="bi bi-people fs-3"
                                    aria-hidden="true"></i>
                            </div>

                            <h3 class="h5 fw-semibold">
                                Participantes
                            </h3>

                            <p class="text-secondary">
                                Consulte os participantes e gerencie seus
                                cadastros.
                            </p>

                            <a
                                href="?pagina=participantes"
                                class="btn btn-festival mt-2">
                                Gerenciar participantes
                            </a>

                        </div>

                    </div>

                </div>

                <!-- Card de atividades -->
                <div class="col-12 col-md-6 col-xl-4">

                    <div class="card h-100">

                        <div class="card-body p-4">

                            <div
                                class="rounded-3 p-3 mb-3"
                                style="background-color: var(--festival-nevoa); color: var(--festival-verde);">
                                <i
                                    class="bi bi-calendar-event fs-3"
                                    aria-hidden="true"></i>
                            </div>

                            <h3 class="h5 fw-semibold">
                                Atividades
                            </h3>

                            <p class="text-secondary">
                                Organize as atividades do festival, seus
                                horários, locais e capacidades.
                            </p>

                            <a
                                href="?pagina=atividades"
                                class="btn btn-festival mt-2">
                                Gerenciar atividades
                            </a>

                        </div>

                    </div>

                </div>

                <!-- Card de inscrições -->
                <div class="col-12 col-md-6 col-xl-4">

                    <div class="card h-100">

                        <div class="card-body p-4">

                            <div
                                class="rounded-3 p-3 mb-3"
                                style="background-color: var(--festival-nevoa); color: var(--festival-verde);">
                                <i
                                    class="bi bi-clipboard-check fs-3"
                                    aria-hidden="true"></i>
                            </div>

                            <h3 class="h5 fw-semibold">
                                Inscrições
                            </h3>

                            <p class="text-secondary">
                                Acompanhe as inscrições dos participantes
                                nas atividades.
                            </p>

                            <a
                                href="?pagina=inscricoes"
                                class="btn btn-festival mt-2">
                                Gerenciar inscrições

                            </a>

                        </div>

                    </div>

                </div>

            </div>

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