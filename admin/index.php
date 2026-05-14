<?php

require '../includes/app.php';
isAuth();

use App\Propertie;

//implementar un metodo para  obtener las propiedades utilizando active records
$properties = Propertie::getAll();

//Mostrar mensaje condicional
$result = $_GET['result'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        $propertie = Propertie::getPropertie($id);
        $propertie->delete();
    }
}

//incluir template


includeTemplate('header');


?>

<main class="contenedor">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($result) === 1): ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php elseif (intval($result) === 2): ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php elseif (intval($result) === 3): ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p
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
                <?php foreach ($properties as $propertie): ?>
                    <tr>
                        <td><?= $propertie->id; ?></td>
                        <td><?= $propertie->title; ?></td>
                        <td><img src="../images/<?= $propertie->image; ?>" class="imagen-tabla" alt=""></td>
                        <td>$<?= $propertie->price; ?></td>
                        <td>
                            <form method="POST" class="w-100">
                                <input type="hidden" name="id" value="<?= $propertie->id; ?>">
                                <input type="submit" value="Eliminar" class="boton-rojo-block">
                            </form>
                            <a href="propiedades/update.php?id=<?= $propertie->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</main>

<?php

//Cerrar la conexion
mysqli_close($db);

includeTemplate('footer');
?>