<?php

require '../includes/app.php';
isAuth();

use App\Propertie;
use App\Seller;


//implementar un metodo para  obtener las propiedades utilizando active records
$properties = Propertie::getAll();
$sellers = Seller::getAll();

//Mostrar mensaje condicional
$result = $_GET['result'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        $type = $_POST['type'];
        if(validateContentType($type)) {
            //Compara lo que vamos a eliminar
            if($type === 'seller') {
                $seller = Seller::getPropertie($id);
                $seller->delete();
            }else if ($type === 'propertie') {
                $propertie = Propertie::getPropertie($id);
                $propertie->delete();
            } else {

            }
        }

        
    }
}

//incluir template


includeTemplate('header');


?>

<main class="contenedor">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($result) === 1): ?>
        <p class="alerta exito">Creado correctamente</p>
    <?php elseif (intval($result) === 2): ?>
        <p class="alerta exito">Actualizado correctamente</p>
    <?php elseif (intval($result) === 3): ?>
        <p class="alerta exito">Eliminado correctamente</p>
    <?php endif; ?>

    <a href="propiedades/create.php" class="boton boton-verde">Nueva propiedad</a>
    <a href="vendedores/create.php" class="boton boton-amarillo">Nuevo vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($properties as $propertie): ?>
                <tr>
                    <td><?= $propertie->id; ?></td>
                    <td><?= $propertie->titulo; ?></td>
                    <td><img src="../images/<?= $propertie->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td>$<?= $propertie->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?= $propertie->id; ?>">
                            <input type="hidden" name="type" value="propertie">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="propiedades/update.php?id=<?= $propertie->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>


    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($sellers as $seller): ?>
                <tr>
                    <td><?= $seller->id; ?></td>
                    <td><?= $seller->nombre . " " . $seller->apellido; ?></td>
                    <td>$<?= $seller->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?= $seller->id; ?>">
                            <input type="hidden" name="type" value="seller">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="vendedores/update.php?id=<?= $seller->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</main>

<?php


includeTemplate('footer');
?>