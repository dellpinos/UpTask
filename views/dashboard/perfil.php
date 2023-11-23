<div class="principal">
    <div class="contenido">
        <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>

        <div class="contenedor-sm">
            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            
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
            
            <a href="/tasktrack/cambiar-password" class="enlace perfil__enlace">Cambiar password</a>

            <div class="perfil__graficos">
                <div class="perfil__grafico">
                    <canvas id="grafico-tareas" width="400" height="400"></canvas>
                    <div class="perfil__contadores">
                        <p>Total de tareas: <span id="total_tareas" ></span></p>
                        <p>Tareas completadas: <span id="total_tareas_completadas" ></span></p>
                    </div>
                </div>
                <div class="perfil__grafico">
                    <canvas id="grafico-proyectos" width="400" height="400"></canvas>
                    <div class="perfil__contadores">
                        <p>Total de proyectos: <span id="total_proyectos" ></span></p>
                        <p>Proyectos completados: <span id="total_proyectos_completados" ></span></p>
                    </div>
                </div>
            </div>


        </div>


        <?php
        $script = '
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="/build/js/perfil.js"></script>
        ';
