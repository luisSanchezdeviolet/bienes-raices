<?php

session_start();

if(!$_SESSION['login']) {
    header("Location: ../index.php");
}

    require '../../includes/functions.php';
    
    includeTemplate('header' );
?>

    <main class="contenedor">
        <h1>Borrar</h1>
    </main>

<?php
    includeTemplate('footer' );
?>