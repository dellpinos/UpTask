<div class="principal">
                <div class="contenido">
                    <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>

    <div class="contenedor-sm">
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



<?php
$script = '
<script src="/build/js/tareas_1.1.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
';

