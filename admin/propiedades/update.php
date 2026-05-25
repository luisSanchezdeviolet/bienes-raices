<?php

use App\Propertie;
use App\Seller;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;


require '../../includes/app.php';

isAuth();


$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../index.php');
}

//Obtener los datos de la propiedad
$propertie = Propertie::getPropertie($id);




//Consultar para obtener los vendedores
$vendedores = Seller::getAll();

//Arreglo con mensajes de errores
$errors = Propertie::getErrors();




//Ejeecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //Asignar los atributos
    $args = $_POST['propertie'];
    $propertie->sync($args);
    

    //validacion
    $errors = $propertie->validate();

    //Subida de archivos
    $imageName = md5(uniqid(rand(), true)) . '.jpg';

    if ($_FILES['propertie']['tmp_name']['imagen']) {
        $manager = new Image(new Driver());
        $imagen = $manager->read($_FILES['propertie']['tmp_name']['imagen'])->cover(800, 600);
        $propertie->setImage($imageName);
    }

    if (empty($errors)) {
        if ($_FILES['propertie']['tmp_name']['imagen']) {
            //Almacenar la imagen
            
            $imagen->save(IMAGE_FOLDER.$imageName);
        }

        $propertie->save();

        
    }
}



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
        <?php include '../../includes/templates/form_properties.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>