<div class="principal">
    <div class="contenido">
        <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>

        <div class="contenedor-sm">
            <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

            <form class="formulario" method="POST" action="actualizar-proyecto?id=<?php echo $proyecto->url; ?>">
                <div class="campo">
                    <label for="proyecto">Nuevo nombre</label>
                    <input type="text" id="proyecto" name="proyecto" value="<?php echo $proyecto->proyecto; ?>">
                </div>
                <input type="submit" value="Guardar cambios">
            </form>
            <form class="formulario" method="POST" action="eliminar-proyecto">
            <legend class="legend-campo">El proyecto será eliminado completamente, no hay vuelta atras.</legend>
                <input type="hidden" name="proyecto-hidden" value="<?php echo $proyecto->url; ?>">
                <input  type="submit" value="Eliminar proyecto">
            </form>

        </div>