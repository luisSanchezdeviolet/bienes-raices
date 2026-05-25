<?php

require '../../includes/app.php';
use App\Seller;

isAuth();

$seller = new Seller;

$errors = Seller::getErrors();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

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