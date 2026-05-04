<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono recamaras">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro ipsa vero, quo nihil distinctio alias non. Nisi ipsa fugit tempora est sapiente dolores accusantium voluptas illo, perspiciatis commodi eligendi cumque.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro ipsa vero, quo nihil distinctio alias non. Nisi ipsa fugit tempora est sapiente dolores accusantium voluptas illo, perspiciatis commodi eligendi cumque.</p>

        </div>
    </main>

   <?php
    include 'includes/templates/footer.php'; 
?>