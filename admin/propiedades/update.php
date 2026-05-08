<?php
session_start();

if(!$_SESSION['login']) {
    header("Location: ../index.php");
}


$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: ../index.php');
}

//Base de datos
require '../../includes/config/database.php';
$db = dbConnect();

//Obtener los datos de la propiedad
$request = "SELECT * FROM properties WHERE id = ${id}";
$result = mysqli_query($db, $request);
$propertie = mysqli_fetch_assoc($result);



//Consultar para obtener los vendedores
$consult = "SELECT * FROM sellers";
$result = mysqli_query($db, $consult);

//Arreglo con mensajes de errores
$errors = [];

$title = $propertie['title'];
$price = $propertie['price'];
$description = $propertie['description'];
$rooms = $propertie['rooms'];
$wc = $propertie['wc'];
$parking = $propertie['parking'];
$seller = $propertie['sellers_id'];
$propertieImage = $propertie['image'];


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
    $image = $_FILES['image'];

    // var_dump($image);

    if (!$title) {
        $errors[] = 'Debes añadir un titulo';
    }

    if (!$price) {
        $errors[] = 'El precio es Obligatorio';
    }

    if (!strlen($description) > 50) {
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



    //Validar por tamaño (100kb)
    $size = 10000 * 100;
    if($image['size'] > $size) {
        $errors[] = 'La imagen es muy pesada';
    }

    if (empty($errors)) {

        //crear carpeta
        $imageFolder = '../../images/';
        if(!is_dir($imageFolder)) {
            mkdir($imageFolder);
        }

        $imageName = '';

        //Subida de archivos

        if($image['name']) {
            //Eliminar imagen previa
            unlink($imageFolder.$propertie['image']);
            // //Generar nombre unico
            $imageName = md5(uniqid(rand(), true)).'.jpg';

            // //Subir la imagen
            move_uploaded_file($image['tmp_name'], $imageFolder.$imageName);
        }else {
            $imageName = $propertie['image'];
        }

        



        

        //Insertar en la base de datosd
        $query = "UPDATE properties SET title = '${title}', price = ${price}, image = '${imageName}', description = '${description}', rooms = ${rooms}, wc = ${wc}, parking = ${parking}, sellers_id = ${seller} WHERE id = ${id}";


        $result = mysqli_query($db, $query);

        if ($result) {
            //Redireccionar al usuario
            header('Location: ../index.php?result=2');
        }
    }
}


require '../../includes/functions.php';

includeTemplate('header');
?>

<main class="contenedor">
    <h1>Actualizar Propiedad</h1>



    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errors as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>

    <?php endforeach; ?>
    <form method="POST" class="formulario" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="title">Titulo:</label>
            <input type="text" id="title" name="title" placeholder="Titulo Propiedad" value="<?= $title; ?>">

            <label for="price">Precio:</label>
            <input type="number" id="price" name="price" placeholder="Precio Propiedad" value="<?= $price; ?>">

            <label for="image">Imagen:</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png">
            <img src="../../images/<?= $propertieImage; ?>" class="imagen-small" alt="">

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

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>