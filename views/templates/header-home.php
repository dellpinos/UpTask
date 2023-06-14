<body>
    <header>
        <div class="home__barra">
            <a href="/">
                <h1>TaskTrack</h1>
            </a>
            <div class="home__mobile-menu">
                <img src="/build/img/burger.svg" alt="icono menu responsive">
            </div>

            <div class="home__derecha">
                <!-- dark-mode-boton -->
                <nav class="home__navegacion">
                        <a href="/login">Login</a>
                        <a href="/crear">Sign Up</a>
                        <a href="/info-app">App</a>
                        <a href="/blog">Blog</a>
                        <a href="/contact">Contacto</a>
                </nav>
            </div>
        </div> <!-- cierre de la barra-->

        <?php if ($inicio) {
            echo '
        <div class="home__header">
            <div class="contenedor home__contenido-header">
                <a href="/login" class="home__contenedor__boton">
                    <p class="home__boton">Iniciar Sesión</p>
                </a>
            </div>
        </div>
        ';
        } ?>





    </header>