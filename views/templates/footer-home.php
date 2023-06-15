<footer class="home__footer">
    <div class="home__barra">
        <p class="home__barra-texto">Muchas de las imagenes son Designed by Freepik.</p>
        <nav class="home__navegacion home__navegacion--footer">
            <a href="/login">Login</a>
            <a href="/crear">Sign Up</a>
            <a href="/info-app">App</a>
            <a href="/blog">Blog</a>
            <a href="/contact">Contacto</a>
        </nav>
    </div>
    <p class="copyright">Todos los derechos Reservados <?php $fecha = date('Y');
                                                                            echo $fecha; ?> &copy; </p>

</footer>
<?php
$script = '';
$script .= '
<script src="build/js/home.js"></script>
'; ?>
</body>