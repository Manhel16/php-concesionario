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
    <title>crear usuario</title>
</head>
<style>
    form {
        text-align: center;
    }

    .formulario-registro{
        width: 50%;
        align-items: center;
        background-color: lightblue;
        padding: 20px;
        border: 3px solid black;
        margin-left: 20%;
        padding: 30px;
    }
    input[type=text],input[type=password] , select {
        margin: 20px;
        padding: 5px;
        font-size: 16px;
        display: inline-block;
        width: 70%;
        height: auto;
        box-sizing: border-box;
        }
    select{
        text-align: center;
    }
</style>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO('mysql:host=localhost;dbname=id21519445_vehiculos;charset=utf8', 'id21519445_vehiculosconcesionario', 'Abcd1234!');
        if (!empty($_POST['nuevo_usuario']) && !empty($_POST['nueva_contraseña']) && isset($_POST['tipo_usuario'])) {
            $nuevoUsuario = $_POST['nuevo_usuario'];
            $nuevaContrasena = $_POST['nueva_contraseña'];
            $tipoUsuario = $_POST['tipo_usuario'];

            $stmt = $conn->prepare('INSERT INTO usuarios (nombre_usuario, contraseña, tipo_usuario) VALUES (:nuevoUsuario, :nuevaContrasena, :tipoUsuario)');
            $stmt->execute(array(':nuevoUsuario' => $nuevoUsuario, ':nuevaContrasena' => $nuevaContrasena, ':tipoUsuario' => $tipoUsuario));

            if ($stmt) {
                $mensaje = "<p id='textoerror'>Usuario agregado con éxito</p>";
                header('location: login.php');
            } else {
                $mensaje = "<p id='textoerror'>Error al agregar usuario</p>";
            }
        } else {
            $mensaje = "<p id='textoerror'>Por favor, complete todos los campos.</p>";
        }
    }
    ?>

    <form class="formulario-registro" id="form" action="" method="post">
        <h1>añade el usuario que necesites</h1>
        <?php
        if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>
        Nuevo Usuario: <input type="text" name="nuevo_usuario" class="inputs" ><br>
        Nueva Contraseña: <input type="password" name="nueva_contraseña" class="inputs" ><br>
        Tipo de Usuario: <select name="tipo_usuario" class="inputs" >
            <option value="administrador">Administrador</option>
            <option value="usuario_normal">Usuario Normal</option>
        </select><br>
        <input  type="submit" class='btn btn-primary' value="Agregar Usuario">
        <a href="login.php"><button class="btn btn-info">Volver a la página de inicio de sesión</button></a>
    </form>
</body>

</html>