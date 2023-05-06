<div class="contenedor restablecer">

    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo Password</p>

        <form action="/restablecer" class="formulario" method="POST">
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Password">
            </div>

            <input type="submit" class="boton" value="Guardar Password">
        </form>

        <div class="acciones">
            <a href="/crear">Todavía no tenes una cuenta?</a>
            <a href="/">Iniciar Sesión</a>
        </div>
    </div> <!-- .contenedor-sm -->
</div>