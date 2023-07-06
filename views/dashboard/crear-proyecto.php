<div class="principal">
                <div class="contenido">
                    <h2 class="nombre-pagina" id="nombre-pagina"><?php echo $titulo; ?></h2>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form class="formulario" method="POST" action="crear-proyecto">
        <?php include_once __DIR__ . '/formulario-proyecto.php'; ?>
        <input type="submit" value="Crear Proyecto">
    </form>
</div>



