<?php

require 'app.php';

function includeTemplate($name, $inicio = false) {
    include TEMPLATES_URL."/${name}.php"; 

}