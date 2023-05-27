<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver al Perfil</a>

    <form class="formulario" method="POST" action="/cambiar-password">
        <div class="campo">
            <label for="password_actual">Password Actual</label>
            <input type="password" name="password_actual" placeholder="Tu password actual">
        </div>
        <div class="campo">
            <label for="passwordNuevo">Nuevo Password</label>
            <input type="password" name="password_nuevo" placeholder="Tu nuevo password">
        </div>
        <div class="campo">
            <label for="repetirPasswordNuevo">Repetir Nuevo Password</label>
            <input type="password" name="password2" placeholder="Tu nuevo password">
        </div>

        <input type="submit" value="Guardar cambios">
    </form>
</div>


<?php include_once __DIR__ . '/footer-dashboard.php'; ?>