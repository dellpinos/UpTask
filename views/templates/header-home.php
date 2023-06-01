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
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>
        </div> <!-- cierre de la barra-->

        <div class="home__header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="home__contenedor home__contenido-header">
            <?php echo $inicio ? '<h1>Organiza tus Proyectos</h1>' : ''; ?>    
            <div class="home__contenedor__boton">
                    <p class="home__boton">Crear Proyecto</p>
                </div>
                
            </div>
        </div>

    </header>