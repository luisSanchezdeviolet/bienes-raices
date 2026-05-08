<?php

require 'includes/config/database.php';

$db = dbConnect();

$errors = [];

//Autenticar el usuario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    

    if(!$email) {
        $errors[] = 'El email es obligatorio o no es valido';
    }

    if(!$password) {
        $errors[] = 'El password es obligatorio';
    }

    if(empty($errors)) {
        //Revisar siu el usuario existe
        $query = "SELECT * FROM users WHERE email = '${email}'";
        $result = mysqli_query($db, $query);

        if($result->num_rows) {
            //Revisar si el password es correcto
            $user = mysqli_fetch_assoc($result);

            //verificar si el password es correcto o no
            $auth = password_verify($password, $user['password']);

            if($auth) {
                //El usuarioe sta autenticado
                session_start();

                //llenar el arreglo de la sesion
                $_SESSION['user'] = $user['email'];
                $_SESSION['login'] = true;
                header("Location: admin/index.php");
            }else {
                $errors[] = "El password es incorrecto";
            }

        }else{
            $errors[] = "El usuario no existe";
        }
    }
}

//Incluye el header
require 'includes/functions.php';

includeTemplate('header');
?>

<main class="contenedor">
    <h1>Iniciar sesion</h1>

    <?php foreach($errors as $error): ?>
        <div class="alerta error">
            <?= $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <legend>Email y Password</legend>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu email" required>

        <label for="password">password</label>
        <input type="password" id="password" name="password" placeholder="Tu password" required>

        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>

</main>

<?php
includeTemplate('footer');
?>