<?php

    require 'includes/functions.php';
    
    includeTemplate('header' );
?>

    <main class="contenedor">
        <h2>Casas y depas en venta</h2>
        
        <?php
            $limit = 10; 
            include 'includes/templates/anuncios.php'; 
        ?>

    </main>

<?php
    includeTemplate('footer' );
?>