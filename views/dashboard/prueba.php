<h1><?php echo $titulo; ?></h1>


<div class="contendor">
    <div>
    <label for="input-test">Input: </label>
        <input id="input-test" type="text" placeholder="Ingresa texto">
        <button id="btn-prueba">Enviar</button>
    </div>
        


    <div class="contenedor-sm">
        <h4>Output</h4>
        <p id="output-test"></p>
    </div>

</div>


<?php
$script = '
<script src="/build/js/assistant_1.2.js" defer></script>
';
