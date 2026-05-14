<?php

use App\Propertie;

require '../../includes/app.php';

isAuth();


$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: ../index.php');
}

//Obtener los datos de la propiedad
$propertie = Propertie::getPropertie($id);




//Consultar para obtener los vendedores
$consult = "SELECT * FROM sellers";
$result = mysqli_query($db, $consult);

//Arreglo con mensajes de errores
$errors = Propertie::getErros();




//Ejeecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    //Asignar los atributos
    $args = $_POST['propertie'];


    $propertie->sync($args);


    $errors = $propertie->validate();

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