<?php

require '../../includes/functions.php';

includeTemplate('header');
?>

<main class="contenedor">
    <h1>Crear</h1>
    <a href="../index.php" class="boton boton-verde">Volver</a>

    <form action="" class="formulario">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="title">Titulo:</label>
            <input type="text" id="title" name="title" placeholder="Titulo Propiedad">

            <label for="price">Precio:</label>
            <input type="number" id="price" name="price" placeholder="Precio Propiedad">

            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png">

            <label for="description">Descripcion</label>
            <textarea name="description" id="description"></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="rooms">Habitaciones:</label>
            <input type="number" id="rooms" name="rooms" placeholder="Ej: 3" min="1" max="9">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9">

            <label for="parking">Estacionamiento:</label>
            <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="" id="">
                <option value="1">Juan</option>
                <option value="2">Karen</option>
            </select>

        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>