<div class="principal">
    <div class="contenido">
        <a href="/tasktrack/actualizar-proyecto?id=<?php echo $token; ?>">
            <div class="contenedor-titulo">

                <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>
                <i class="fa-solid fa-pen titulo-icono"></i>
            </div>
        </a>

        <div class="contenedor tareas__contenedor">

            <div class="tareas__contenedor-sm">
                <div class="contenedor-nueva-tarea">
                    <button type="button" class="agregar-tarea" id="agregar-tarea">&#43; Nueva Tarea</button>
                </div>

                <div id="filtros" class="filtros">
                    <div class="filtros-inputs">
                        <h2>Filtros:</h2>
                        <div class="campo">
                            <label for="todas">Todas</label>
                            <input type="radio" id="todas" name="filtro" value="" checked>
                        </div>
                        <div class="campo">
                            <label for="completadas">Completadas</label>
                            <input type="radio" id="completadas" name="filtro" value="1">
                        </div>
                        <div class="campo">
                            <label for="pendientes">Pendientes</label>
                            <input type="radio" id="pendientes" name="filtro" value="0">
                        </div>
                    </div>
                </div>

                <ul class="listado-tareas" id="listado-tareas"></ul>
            </div>

            <aside class="tareas__generadas">
                <div class="tareas__sugeridas">
                    <h4>Tareas IA</h4>
                    <p>Generar tareas automaticamente con IA</p>
                    <label for="tareas-previas">Tener en cuenta tareas actuales: </label>
                    <input id="tareas-previas" type="checkbox">
                </div>

                <button id="btn-tareas__sugeridas" class="tareas__generar">Generar Tareas</button>
                <ul class="tareas__ia-generadas" id="tareas-ia-generadas"></ul>


            </aside>

        </div>

        <?php
        $script = '
<script src="/build/js/tareas_1.2.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
';
