<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Organizador de proyectos y tareas">
    <title>TaskTrack | <?php echo $titulo ?? ''; ?></title>
    <link rel="preload" href="/build/css/app_1.1.css" as="style">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Noto+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app_1.1.css">
</head>

<body class="dashboard">

    <?php include_once __DIR__ . '/dashboard/header-dashboard.php'; ?>

    <div class="dashboard__grid">

        <?php include_once __DIR__ . '/templates/sidebar.php'; ?> <!-- Cambiar de posicion esta barra -->

        <main class="dashboard__contenido">

            <?php echo $contenido; ?>
        </main>
    </div>


    <?php include_once __DIR__ . '/dashboard/footer-dashboard.php'; ?>

    <?php echo $script ?? ''; ?>

</body>

</html>