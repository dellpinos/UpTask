<aside class="dashboard__sidebar">

        <div class="dashboard__cerrar-mobile">
            <img id="cerrar-menu" src="/build/img/cerrar.svg" alt="Imagen cerrar menu">
        </div>



    <nav class="dashboard__sidebar-nav">
        <a class="dashboard__enlace <?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/tasktrack/dashboard">

        <i class="fa-regular fa-folder-open dashboard__icono"></i>
        Proyectos</a>
        <a class="dashboard__enlace <?php echo ($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>" href="/tasktrack/crear-proyecto">

        <i class="fa-solid fa-plus dashboard__icono"></i>
        Crear Proyectos</a>
        <a class="dashboard__enlace <?php echo ($titulo === 'Tu Perfil') ? 'activo' : ''; ?>" href="/tasktrack/perfil">
        <i class="fa-solid fa-user dashboard__icono"></i>
        Perfil</a>

    </nav>

    <div class="dashboard__cerrar-sesion-mobile">
        <a href="/logout" class="dashboard__cerrar-sesion">Cerrar sesión</a>
    </div>
</aside>