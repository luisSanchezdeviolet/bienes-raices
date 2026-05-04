<?php

    require 'includes/functions.php';
    
    includeTemplate('header' );
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img src="build/img/destacada2.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>
        <p class="informacion-meta">Escrito el: <span>20/10/2025</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro ipsa vero, quo nihil distinctio alias non. Nisi ipsa fugit tempora est sapiente dolores accusantium voluptas illo, perspiciatis commodi eligendi cumque.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro ipsa vero, quo nihil distinctio alias non. Nisi ipsa fugit tempora est sapiente dolores accusantium voluptas illo, perspiciatis commodi eligendi cumque.</p>

        </div>
    </main>

<?php
    includeTemplate('footer' );
?>