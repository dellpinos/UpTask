<body>
    <header>
        <div class="home__barra">
            <a href="/">
                <h1>TaskTrack</h1>
                <!-- <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices"> -->
            </a>
            <div class="home__mobile-menu">
                <!-- <img src="/build/img/barras.svg" alt="icono menu responsive"> -->
            </div>

            <div class="home__derecha">
                <!-- <img class="dark-mode-boton" src="/build/img/dark-mode.svg"> -->
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