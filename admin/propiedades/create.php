<?php

require '../../includes/app.php';

use App\Propertie;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

isAuth();



//Base de datos
$db = dbConnect();

$propertie = new Propertie($_POST['propertie']);

//Consultar para obtener los vendedores
$consult = "SELECT * FROM sellers";
$result = mysqli_query($db, $consult);

$errors = Propertie::getErros();





//Ejeecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $propertie = new Propertie($_POST);

    //Generar nombre unico
    $imageName = md5(uniqid(rand(), true)) . '.jpg';
    if($_FILES['propertie']['tmp_name']['image']) {
        $manager = new Image(Driver::class);
        $image = $manager->read($_FILES['propertie']['tmp_name']['image'])->cover(800,600);
        $propertie->setImage($imageName);
    }

    $errors = $propertie->validate();



    if (empty($errors)) {


        //Subida de archivos

        //crear carpeta
        if (!is_dir(IMAGE_FOLDER)) {
            mkdir(IMAGE_FOLDER);
        }
        
        //Guarda la imagen en el servidor
        $image->save(IMAGE_FOLDER.$imageName);

        $result = $propertie->save();
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
        <?php include '../../includes/templates/form_properties.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>