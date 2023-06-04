<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/cambiar-password" class="enlace">Cambiar password</a>

    <form class="formulario" method="POST" action="/perfil">
        <div class="campo">
            <label for="nombre_perfil">Nombre</label>
            <input type="text" id="nombre_perfil" value="<?php echo $usuario->nombre; ?>" name="nombre" placeholder="Tu nombre">
        </div>
        <div class="campo">
            <label for="apellido_perfil">Apellido</label>
            <input type="text" id="apellido_perfil" value="<?php echo $usuario->apellido; ?>" name="apellido" placeholder="Tu apellido">
        </div>
        <div class="campo">
            <label for="email_perfil">Email</label>
            <input type="email" id="email_perfil" value="<?php echo $usuario->email; ?>" name="email" placeholder="Tu email">
        </div>

        <input type="submit" value="Guardar cambios">
    </form>
</div>


<?php include_once __DIR__ . '/footer-dashboard.php'; ?>