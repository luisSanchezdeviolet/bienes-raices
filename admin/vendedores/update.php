<?php

require '../../includes/app.php';
use App\Seller;
isAuth();

//Validar que sea un id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);


if(!$id) {
    header('Location: /admin');
}

//Obtener el arreglo de vendedor
$seller = Seller::getPropertie($id);


//Arreglo de errores
$errors = Seller::getErrors();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Asignar los valores
    $args = $_POST['seller'];
    //sincronizar objeto en memoria con lo que el usuario escribio
    $seller->sync($args);

    //Validacion
    $errors = $seller->validate();

    if(empty($errors)) {
        $seller->save();
    }

}


includeTemplate('header');
?>


<main class="contenedor">
    <h1>Actualizar Vendedor(a)</h1>



    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errors as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>

    <?php endforeach; ?>
    <form method="POST" action="../vendedores/update.php?id=<?= $id; ?>" class="formulario">
        <?php include '../../includes/templates/form_sellers.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>