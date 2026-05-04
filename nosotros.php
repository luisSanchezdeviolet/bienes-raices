<?php include 'includes/templates/header.php'; ?>

    <main class="contenedor">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp" />
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam accusamus, modi exercitationem nulla repellat minima expedita excepturi, nobis architecto fugiat dignissimos? Blanditiis impedit tempora, libero natus dolorem at beatae dolor.</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam vel, laudantium maxime ipsam, saepe nihil quasi.</p>
            </div>
        </div>
    </main>


    <section class="contenedor">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error harum rem reprehenderit consequuntur optio tempore? Corrupti odio totam deserunt tenetur sit eligendi doloremque enim quasi, quas laudantium impedit, non laboriosam!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error harum rem reprehenderit consequuntur optio tempore? Corrupti odio totam deserunt tenetur sit eligendi doloremque enim quasi, quas laudantium impedit, non laboriosam!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A tiempo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error harum rem reprehenderit consequuntur optio tempore? Corrupti odio totam deserunt tenetur sit eligendi doloremque enim quasi, quas laudantium impedit, non laboriosam!</p>
            </div>
        </div>

    </section>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los derechos reservados 2026 &copy;</p>
    </footer>

    <script src="build/js/bundle.min.js"></script>
</body>

</html>