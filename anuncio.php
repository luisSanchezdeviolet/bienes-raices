<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id) {
        header('Location: index.php');
    }

    require 'includes/config/database.php';
    $db = dbConnect();

    //consultar
    $query = "SELECT * FROM properties WHERE id = ${id}";

    //obtener el resultado
    $result = mysqli_query($db, $query);

    if(!$result->num_rows) {
        header('Location: index.php');
    }

    $propertie = mysqli_fetch_assoc($result);

    require 'includes/functions.php';
    
    includeTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?= $propertie['title']; ?></h1>

        <img src="images/<?= $propertie['image']; ?>" alt="Imagen de la propiedad" loading="lazy">


        <div class="resumen-propiedad">
            <p class="precio">$<?= $propertie['price']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                    <p><?= $propertie['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?= $propertie['parking']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono recamaras">
                    <p><?= $propertie['rooms']; ?></p>
                </li>
            </ul>

            <p><?= $propertie['description']; ?>.</p>

        </div>
    </main>

   <?php

    mysqli_close($db);

    includeTemplate('footer' );
?>