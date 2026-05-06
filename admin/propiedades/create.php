<?php

//Base de datos
require '../../includes/config/database.php';
$db = dbConnect();

//Consultar para obtener los vendedores
$consult = "SELECT * FROM sellers";
$result = mysqli_query($db, $consult);

//Arreglo con mensajes de errores
$errors = [];

$title = '';
$price = '';
$description = '';
$rooms = '';
$wc = '';
$parking = '';
$seller = '';
$create = date('Y/m/d');


//Ejeecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $title = mysqli_real_escape_string($db, $_POST['title']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $rooms = mysqli_real_escape_string($db, $_POST['rooms']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $parking = mysqli_real_escape_string($db, $_POST['parking']);
    $seller = mysqli_real_escape_string($db, $_POST['seller']);


    //Asignar files hacia una variable
    $image = $_FILES['imagen'];

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

    if($image['name'] || $image['error']) {
        $errors[] = 'La imagen es obligatoria';
    }

    //Validar por tamaño (100kb)
    $size = 1000 * 100;
    if($image['size'] > $size) {
        $errors[] = 'La imagen es muy pesada';
    }

    if (empty($errors)) {
        //Insertar en la base de datosd
        $query = "INSERT INTO properties (title, price, description, rooms, wc, parking, date , sellers_id) VALUES ('$title', '$price', '$description', '$rooms', '$wc', '$parking', '$create' ,'$seller') ";

        $result = mysqli_query($db, $query);

        if ($result) {
            //Redireccionar al usuario
            header('Location: ../admin');
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
    <form method="POST" action="../propiedades/create.php" class="formulario" enctype="multipart/form-data">
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
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <option  <?= $seller === $row['id'] ? 'selected' : ''; ?>  value="<?= $row['id']; ?>"><?= $row['name']." ".$row['last_name']; ?></option>

                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>