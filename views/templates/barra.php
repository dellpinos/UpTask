<div class="barra-mobile">
    <a href="/dashboard">
        <h1>TaskTrack</h1>
    </a>
    
    <div class="menu">
        <img id="mobile-menu" src="build/img/burger.svg" alt="Imagen menu">
    </div>
</div>



<div class="barra">
    <p>Usuario: <span><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></span></p>

    <a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>

</div>