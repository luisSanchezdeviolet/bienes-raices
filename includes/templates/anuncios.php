<?php

    //importar la conexion
    $db = dbConnect();

    //consultar
    $query = "SELECT * FROM propiedades LIMIT ${limit}";

    //obtener el resultado
    $result = mysqli_query($db, $query);

?>


<div class="contenedor-anuncios">
            <?php while($propertie = mysqli_fetch_assoc($result)): ?>
            <div class="anuncio">

                <img src="images/<?= $propertie['image']; ?>" alt="anuncio">
                

                <div class="contenido-anuncio">
                    <h3><?= $propertie['title']; ?></h3>
                    <p><?= $propertie['description']; ?></p>
                    <p class="precio">$ <?= $propertie['price']; ?></p>

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

                    <a href="anuncio.php?id=<?= $propertie['id']; ?>" class="boton-amarillo-block">
                        Ver propiedad
                    </a>
                </div><!--Contenido anuncio-->
            </div><!--anuncio-->
            <?php endwhile; ?>
        </div><!--Contenido-->


<?php
//Cerrar la conexion

mysqli_close($db);

?>