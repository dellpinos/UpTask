<div class="contenedor olvide">
    
<?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>


    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu Password</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/olvide" class="formulario" method="POST">

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Tu Email">
            </div>

            <input type="submit" class="boton" value="Recuperar cuenta">
        </form>

        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            <a href="/crear">Todavia no tenes cuenta?</a>
        </div>
    </div> <!-- .contenedor-sm -->
</div>