<?php

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCTIONS_URL', 'functions');
DEFINE('IMAGE_FOLDER', __DIR__.'/../images/');


function includeTemplate(string $name, bool $inicio = false) {
    include TEMPLATES_URL."/${name}.php"; 

}


function isAuth(): bool {
    session_start();

    if(!$_SESSION['login']) {
        header("Location: ".__DIR__.'/../index.php');
    }

    return false;
    

}


function debug($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}