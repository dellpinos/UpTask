<div class="principal">
                <div class="contenido">
                    <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/tasktrack/cambiar-password" class="enlace">Cambiar password</a>

    <form class="formulario" method="POST" action="/tasktrack/perfil">
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

    <div class="perfil__contadores">
        <p>Total de proyectos: <?php echo $contadores['total_proyectos']; ?></p>
        <p>Total de proyectos completados: <?php echo $contadores['total_proyectos_completados']; ?></p>
        <p>Total de tareas: <?php echo $contadores['total_tareas']; ?></p>
        <p>Total de tareas completadas: <?php echo $contadores['total_tareas_completadas']; ?></p>


    </div>
</div>

