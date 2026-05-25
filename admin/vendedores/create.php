<?php

require '../../includes/app.php';
use App\Seller;

isAuth();

$seller = new Seller;

$errors = Seller::getErrors();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //crear una nueva instancia
    $seller = new Seller($_POST['seller']);


    //Validar que no haya campos vacios
    $errors = $seller->validate();

    //No hay errores
    if(empty($errors)) {
        $seller->save();
    }

}


includeTemplate('header');
?>


<main class="contenedor">
    <h1>Registrar Vendedor(a)</h1>



    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errors as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>

    <?php endforeach; ?>
    <form method="POST" action="../vendedores/create.php" class="formulario">
        <?php include '../../includes/templates/form_sellers.php'; ?>

        <input type="submit" value="Crear Vendedor" class="boton boton-verde">

    </form>
</main>

<?php
includeTemplate('footer');
?>