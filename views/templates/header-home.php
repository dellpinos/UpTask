
    <header>
        <div class="home__barra">
            <div class="home__barra-contenedor">
                <a href="/">
                    <h1>TaskTrack</h1>
                </a>
                <div class="home__mobile-menu home__mobile-menu--ocultar">
                    <img src="/build/img/burger.svg" alt="icono menu">
                </div>
            </div>


            <div class="home__derecha"> <!-- la clase home__derecha--mobile se añade con Js-->
                <!-- dark-mode-boton -->
                <nav class="home__navegacion"> <!-- la clase home__derecha--mobile se añade con Js-->
                    <a href="/login">Login</a>
                    <a href="/crear">Sign Up</a>
                    <a href="/info-app">App</a>
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