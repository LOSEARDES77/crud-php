<?php
require "class/Plantilla.php";

use App\Crud\Plantilla;

session_start();

if (isset($_SESSION['token'])) {
    header('Location: /sitio.php');
}

function get_form(string $form_type): string
{
    return match ($form_type) {
        'login' => Plantilla::html_login(),
        'register' => Plantilla::html_register(),
        default => Plantilla::html_index(),
    };

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    match ($_POST['submit']) {
        'Entrar' => $form_type = 'login',
        'Registrarse' => $form_type = 'register',
    };
} else {
    $form_type = "none";
}

$form = get_form($form_type);



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD - php</title>
</head>

<body>

    <h1>Bienvenido a la aplicación CRUD</h1>
    <?= $form; ?>




</body>

</html>