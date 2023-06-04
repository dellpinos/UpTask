<?php include_once __DIR__ . '/../templates/header-home.php'; ?>

<div class="contenedor restablecer">
    
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    
    
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo Password</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        
        <?php if($mostrar) : ?>
            
            <form class="formulario" method="POST">
                <div class="campo">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password">
                </div>
                <div class="campo">
                    <label for="password2">Repetir Password</label>
                    <input type="password" id="password2" name="password2" placeholder="Repite tu Password">
                </div>
                
                <input type="submit" class="boton" value="Guardar Password">
            </form>
            
            <div class="acciones">
                <a href="/crear">Todavía no tenes una cuenta?</a>
                <a href="/login">Iniciar Sesión</a>
            </div>
            
            <?php endif; ?>
        </div> <!-- .contenedor-sm -->
    </div>
    
    <?php include_once __DIR__ . '/../templates/footer-home.php'; ?>