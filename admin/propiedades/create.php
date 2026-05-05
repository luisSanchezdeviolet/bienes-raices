<?php

//Base de datos
require '../../includes/config/database.php';
$db = dbConnect();

//Arreglo con mensajes de errores
$errors = [];

$title = '';
$price = '';
$description = '';
$rooms = '';
$wc = '';
$parking = '';
$seller = '';


//Ejeecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $rooms = $_POST['rooms'];
    $wc = $_POST['wc'];
    $parking = $_POST['parking'];
    $seller = $_POST['seller'];

    if (!$title) {
        $errors[] = 'Debes añadir un titulo';
    }

    if (!$price) {
        $errors[] = 'El precio es Obligatorio';
    }

    if (strlen(!$description) < 50) {
        $errors[] = 'La descripcion es Obligatorio y dbee tener al menos 50 caracteres';
    }

    if (!$rooms) {
        $errors[] = 'El numero de habitaciones es obligatorio';
    }

    if (!$wc) {
        $errors[] = 'El numero de baños es obligatorio';
    }

    if (!$parking) {
        $errors[] = 'El numero de estacionamientos es obligatorio';
    }

    if (!$seller) {
        $errors[] = 'Elige un vendedor';
    }

    if (empty($errors)) {
        //Insertar en la base de datosd
        $query = "INSERT INTO properties (title, price, description, rooms, wc, parking, sellers_id) VALUES ('$title', '$price', '$description', '$rooms', '$wc', '$parking', '$seller') ";

        $result = mysqli_query($db, $query);

        if ($result) {
            echo "Insertado correctamente";
        }
    }
}


require '../../includes/functions.php';

includeTemplate('header');
?>

<main class="contenedor">
    <h1>Crear</h1>



    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errors as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>

    <?php endforeach; ?>
    <form method="POST" action="../propiedades/create.php" class="formulario">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="title">Titulo:</label>
            <input type="text" id="title" name="title" placeholder="Titulo Propiedad" value="<?= $title; ?>">

            <label for="price">Precio:</label>
            <input type="number" id="price" name="price" placeholder="Precio Propiedad" value="<?= $price; ?>">

            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png">

            <label for="description">Descripcion</label>
            <textarea name="description" id="description"><?= $description; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="rooms">Habitaciones:</label>
            <input type="number" id="rooms" name="rooms" placeholder="Ej: 3" min="1" max="9" value="<?= $rooms; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?= $wc; ?>">

            <label for="parking">Estacionamiento:</label>
            <input type="number" id="parking" name="parking" placeholder="Ej: 3" min="1" max="9" value="<?= $parking; ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="seller" id="seller">
                <option value="">--Seleccione--</option>
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