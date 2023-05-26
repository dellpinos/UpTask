<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">

    <ul class="listado-proyectos" id="listado-proyectos"></ul>

</div>




<?php include_once __DIR__ . '/footer-dashboard.php'; ?>


<?php
$script = '
<script src="build/js/proyectos.js"></script>
<script src="build/js/app.js"></script>
'; ?>


<!-- <?php if (count($proyectos) === 0) { ?>
    <p class="no-proyectos">No hay proyectos aún.
        <a href="/crear-proyecto">Comienza a crear proyectos !</a>
    </p>
    <?php } else { ?>



    <ul class="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) : ?>

            <a href="/proyecto?id=<?php echo $proyecto->url ?>">
                <li class="proyecto">
                    <p><?php echo $proyecto->proyecto; ?></p>
                </li>
            </a>

        <?php endforeach; ?>
    </ul>

<?php } ?> -->