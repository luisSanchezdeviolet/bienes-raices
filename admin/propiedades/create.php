<?php

require '../../includes/app.php';

use App\Propertie;


isAuth();



//Base de datos
$db = dbConnect();

//Consultar para obtener los vendedores
$consult = "SELECT * FROM sellers";
$result = mysqli_query($db, $consult);

$errors = Propertie::getErros();


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

    $propertie = new Propertie($_POST);

    $errors = $propertie->validate();

   

    if (empty($errors)) {

    $propertie->save();


        //Subida de archivos

        //crear carpeta
        $imageFolder = '../../images/';
        if(!is_dir($imageFolder)) {
            mkdir($imageFolder);
        }



        //Generar nombre unico
        $imageName = md5(uniqid(rand(), true)).'.jpg';

        //Subir la imagen
        move_uploaded_file($image['tmp_name'], $imageFolder.$imageName);

        

        $result = mysqli_query($db, $query);

        if ($result) {
            //Redireccionar al usuario
            header('Location: ../index.php?result=1');
        }
    }
}




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

            <select name="sellers_id" id="seller">
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