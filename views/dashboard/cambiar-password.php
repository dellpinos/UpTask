<div class="principal">
                <div class="contenido">
                    <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/tasktrack/perfil" class="enlace">Volver al Perfil</a>

    <form class="formulario" method="POST" action="/tasktrack/cambiar-password">
        <div class="campo">
            <label for="password_actual">Password Actual</label>
            <input type="password" name="password_actual" id="password_actual" placeholder="Tu password actual">
        </div>
        <div class="campo">
            <label for="passwordNuevo">Nuevo Password</label>
            <input type="password" name="password_nuevo" id="passwordNuevo" placeholder="Tu nuevo password">
        </div>
        <div class="campo">
            <label for="repetirPasswordNuevo">Repetir Nuevo Password</label>
            <input type="password" name="password2" id="repetirPasswordNuevo" placeholder="Tu nuevo password">
        </div>

        <input type="submit" value="Guardar cambios">
    </form>
</div>


