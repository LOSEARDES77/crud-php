<?php

require "class/DB.php";

use App\Crud\DB;

session_start();

if (isset($_SESSION['token'])) {
    $user = DB::getUser($_SESSION['token']);
    if (!is_null($user)) {
        $_SESSION['token'] = $user['token'];
    }
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit'])) {
            switch ($_POST['submit']) {
                case 'Login':
                    $db = new DB();
                    $user = $db->validar_usuario($_POST['nombre'], $_POST['pass']);
                    if ($user !== []) {
                        $_SESSION['token'] = $user['token'];
                    } else {
                        // Handle invalid login attempt
                        echo "Invalid username or password.";
                    }
                    break;

                case 'Logout':
                    unset($_SESSION['token']);
                    break;

                default:
                    // Handle unexpected submit value
                    echo "Unexpected submit value.";
                    break;
            }
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF - 8">
    <meta name="viewport" content="width=device - width, initial - scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="estilo . css">
</head>

<body>
    <h1>Admin Panel</h1>

    <!-- Navigation Buttons -->
    <div>
        <form action="sitio.php" method="post">
            <div>
                Conectado como XXXX <input class="btn btn - logout" type="submit" value="Logout" name="submit">
            </div>
            <hr />
            <input class="btn btn - create" type="submit" value="Productos" name="submit">
            <input class="btn btn - edit" type="submit" value="Tiendas" name="submit">
            <input class="btn btn - delete" type="submit" value="Usuarios" name="submit">
            <input class="btn btn - create" type="submit" value="Stock" name="submit">

        </form>

    </div>

    <!-- Placeholder for Future Content -->
    <div id="content">
        <p>Selecciona una opción para gestionar los elementos de la tienda.</p>
    </div>
</body>

</html>