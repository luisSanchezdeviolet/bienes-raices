<?php


//importar la conexion
require 'includes/config/database.php';
$db = dbConnect();

//crear un email y password
$email = "admin@admin.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);


//query para crear el usuario
$query = "INSERT INTO users (email, password) VALUES ('${email}', '${passwordHash}')";



//Agregarlo a la base de datos
mysqli_query($db, $query);