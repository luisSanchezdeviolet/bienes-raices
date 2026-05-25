<?php

    use App\Propertie;

    $properties = Propertie::getAll();

?>


<div class="contenedor-anuncios">
            <?php foreach($properties as $propertie){ ?>
            <div class="anuncio">

                <img src="images/<?= $propertie->imagen; ?>" alt="anuncio">
                

                <div class="contenido-anuncio">
                    <h3><?= $propertie->titulo; ?></h3>
                    <p><?= $propertie->descripcion; ?></p>
                    <p class="precio">$ <?= $propertie->precio; ?></p>

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

                    <a href="anuncio.php?id=<?= $propertie->id; ?>" class="boton-amarillo-block">
                        Ver propiedad
                    </a>
                </div><!--Contenido anuncio-->
            </div><!--anuncio-->
            <?php } ?>
        </div><!--Contenido-->