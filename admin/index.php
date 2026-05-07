<?php

    $result = $_GET['result'] ?? null;

    require '../includes/functions.php';
    
    includeTemplate('header' );


?>

    <main class="contenedor">
        <h1>Administrador de Bienes Raices</h1>

        <?php if(intval($result) === 1): ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php endif; ?>
        
        <a href="propiedades/create.php" class="boton boton-verde">Nueva propiedad</a>
    </main>

<?php
    includeTemplate('footer' );
?>