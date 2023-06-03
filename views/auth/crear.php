<?php include_once __DIR__ . '/../templates/header-home.php'; ?>


<div class="contenedor auth__contenedor--crear auth__imagen--crear">

    <div class="contenedor-sm">

        <h3 class="descripcion-pagina auth__descripcion">Crea tu cuenta en TaskTrack</h3>

        <?php include_once __DIR__ .  '/../templates/alertas.php'; ?>
        <form action="/crear" class="formulario" method="POST">
            <div class="auth__formulario-campos">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre; ?>">
                </div>
                <div class="campo">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo $usuario->apellido; ?>">
                </div>
                <div class="campo">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo $usuario->email; ?>">
                </div>
                <div class="campo">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password">
                </div>
                <div class="campo">
                    <label for="password2">Repetir Password</label>
                    <input type="password" id="password2" name="password2" placeholder="Repite tu Password">
                </div>
                <div class="auth__formulario-boton">
                    <input type="submit" class="boton" value="Crear Cuenta">
                </div>

            </div>
        </form>

        <div class="acciones">
            <a href="/login">Iniciar Sesión</a>
            <a href="/olvide">Olvidaste tu password?</a>
        </div>
    </div> <!-- .contenedor-sm -->

    <div class="auth__imagen">

    </div>

</div>



<?php include_once __DIR__ . '/../templates/footer-home.php'; ?>