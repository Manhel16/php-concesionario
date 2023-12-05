<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['usuario'])) {
    header("location: login.php"); // Redirigir a la página de inicio de sesión
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>opciones usuario normal</title>
</head>
<style>
    li {
        list-style: none;
        display: flex;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #ccc;
        flex-direction: column;
    }

    a {
        text-decoration: none;
        color: black;
        font-size: 30px;
    }

    #boton {
        margin-top: 3%;
        width: 30%;
        height: auto;
        outline: none;
        margin-left: 35%;
    }

    h1 {
        text-align: center;
    }
</style>

<body>
    <h1>Opciones de usuarioNormal</h1>
    <li><a href="mostrarVehiculosUsuario.php">Consulta</a></li>
    <a href="cerrarSesion.php" id="boton" class="btn btn-info"> cerrar Sesion</a>
</body>

</html>