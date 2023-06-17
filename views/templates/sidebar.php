<aside class="sidebar">
    <div class="contenedor-sidebar">
        <a href="/dashboard">
            <h2>TaskTrack</h2>
        </a>
        <div class="cerrar-menu">
            <img id="cerrar-menu" src="build/img/cerrar.svg" alt="Imagen cerrar menu">
        </div>
    </div>


    <nav class="sidebar-nav">
        <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Proyectos</a>
        <a class="<?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyectos</a>
        <a class="<?php echo ($titulo === 'Tu Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>

    </nav>

    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Cerrar sesión</a>
    </div>
</aside>