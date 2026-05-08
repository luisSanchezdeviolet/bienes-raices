<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienes_raices/build/css/app.css">
</head>

<body>

    <header class="header <?= $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/bienes_raices/build/img/logo.svg" alt="Logotipo bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/bienes_raices/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/bienes_raices/build/img/dark-mode.svg" alt="Boton dark Mode" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                </div>
            </div> <!--Cierre barra-->

            <?php echo $inicio ? "<h1>Venta de casas y departamentos exclusivos de lujos</h1>" : ''; ?>

        </div>

    </header>