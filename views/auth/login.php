<?php include_once __DIR__ . '/../templates/header-home.php'; ?>

<div class="contenedor auth__contenedor">
    <!-- Aca va el include con la imagen y el texto a la izquierda -->
    <div class="auth__imagen">
        <h2>Proyecta tus ideas</h2>
    </div>

    <div class="contenedor login auth__formulario">
        <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

        <div class="contenedor-sm">
            <p class="descripcion-pagina"></p>
            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            <form action="/login" class="formulario" method="POST">
                <div class="auth__formulario-campos">
                    <div class="campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Tu Email">
                    </div>
                    <div class="campo">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Tu Password">
                    </div>
                </div>
                <div class="auth__formulario-boton">
                    <input type="submit" class="boton" value="Iniciar Sesión">
                </div>

            </form>

            <div class="acciones">
                <a href="/crear">Todavía no tenes una cuenta?</a>
                <a href="/olvide">Olvidaste tu password?</a>
            </div>
        </div> <!-- .contenedor-sm -->

    </div>

</div>



<?php include_once __DIR__ . '/../templates/footer-home.php'; ?>