<h1><?php echo $titulo; ?></h1>


<div class="contendor">






    <div class="prueba__contenedor">
        <label for="input-test">Titulo del proyecto: </label>
        <input id="input-test" type="text" placeholder="Ingresa texto">
        <button class="prueba__btn" id="btn-prueba">Generar tareas</button>
    </div>



    <div class="contenedor-sm">
        <h4>Tareas: </h4>
        <ul class="prueba__contenedor-tareas" id="output-test">

        </ul>
    </div>

</div>


<?php
$script = '
<script src="/build/js/assistant_1.2.js" defer></script>
';
