<?php

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCTIONS_URL', 'functions');


function includeTemplate(string $name, bool $inicio = false) {
    include TEMPLATES_URL."/${name}.php"; 

}


function isAuth(): bool {
    session_start();
    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }

    return false;
    

}