<?php

//Importar la conexion
require '../includes/config/database.php';
$db = dbConnect();

//Escribir el query

$query = "SELECT * FROM properties";

//consultar la bd
$resultDb = mysqli_query($db, $query);


//Mostrar mensaje condicional
$result = $_GET['result'] ?? null;

//incluir template
require '../includes/functions.php';

includeTemplate('header');


?>

<main class="contenedor">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($result) === 1): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif (intval($result) === 2): ?>
    <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php endif; ?>

    <a href="propiedades/create.php" class="boton boton-verde">Nueva propiedad</a>

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
            <?php while($property = mysqli_fetch_assoc($resultDb)): ?>
            <tr>
                <td><?= $property['id']; ?></td>
                <td><?= $property['title']; ?></td>
                <td><img src="../images/<?= $property['image']; ?>" class="imagen-tabla" alt=""></td>
                <td>$<?= $property['price']; ?></td>
                <td>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="propiedades/update.php?id=<?= $property['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

<?php

//Cerrar la conexion
mysqli_close($db);

includeTemplate('footer');
?>