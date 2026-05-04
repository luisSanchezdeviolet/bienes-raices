<?php

    require 'includes/functions.php';
    
    includeTemplate('header' );
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form action="" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Tu nombre">

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Tu email">

                <label for="phone">Telefono</label>
                <input type="tel" id="phone" name="phone" placeholder="Tu numero de celular">

                <label for="message">Mensaje</label>
                <textarea name="message" id="message"></textarea>

            </fieldset>


            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="options">Vende o compra</label>
                <select name="options" id="options">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="budget">Precio o presupuesto</label>
                <input type="number" id="budget" name="budget" placeholder="Tu precio o presupuesto">
            </fieldset>


            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="phone-contact">Telefono</label>
                    <input name="contact" type="radio" value="phone-contact" id="phone-contact">

                    <label for="email-contact">E-mail</label>
                    <input name="contact" type="radio" value="email-contact" id="email-contact">
                </div>

                <p>Si eligió teléfono, elija la fecha y la hora para ser contactado</p>

                <label for="date">Fecha</label>
                <input type="date" id="date" name="date">

                <label for="hour">Hora</label>
                <input type="time" id="hour" name="hour" min="09:00" max="18:00">


            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">

        </form>

    </main>

    <?php
    includeTemplate('footer' );
?>