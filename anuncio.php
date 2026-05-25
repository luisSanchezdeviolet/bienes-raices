<?php
require 'includes/app.php';

use App\Propertie;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id) {
        header('Location: index.php');
    }

    $propertie = Propertie::getPropertie($id);
    
    includeTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?= $propertie->titulo; ?></h1>

        <img src="images/<?= $propertie->imagen; ?>" alt="Imagen de la propiedad" loading="lazy">


        <div class="resumen-propiedad">
            <p class="precio">$<?= $propertie->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                    <p><?= $propertie->wc; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?= $propertie->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono recamaras">
                    <p><?= $propertie->habitaciones; ?></p>
                </li>
            </ul>

            <p><?= $propertie->descripcion; ?>.</p>

        </div>
    </main>

   <?php

    mysqli_close($db);

    includeTemplate('footer' );
?>