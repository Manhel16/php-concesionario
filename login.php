<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conn = new PDO('mysql:host=localhost;dbname=id21519445_vehiculos;charset=utf8', 'id21519445_vehiculosconcesionario', 'Abcd1234!');
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :usuario AND contraseña = :contrasena');
    $stmt->execute(array(':usuario' => $usuario, ':contrasena' => $contrasena));

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();

        // Guardar información en la sesión
        $_SESSION['usuario'] = $row['nombre_usuario'];

        if ($row['tipo_usuario'] == 'administrador') {
            header("location: opcionesAdministrador.php");
            exit();
        } else if ($row['tipo_usuario'] == 'usuario_normal') {
            header("location: opcionesUsuarioNormal.php");
            exit();
        }
    } else {
        $mensaje = "<p id='textoerror'>Usuario o contraseña incorrectos </p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Login</title>
</head>
<style>
    html,
    body {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background: linear-gradient(to bottom, #4ca1af, #c4e0e5);
    }

    .caja {
        text-align: center;
        border: solid 2px black;
        width: 120%;
        padding: 80px;
        background-color: lightgoldenrodyellow;
    }

    #form {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }

    #boton {
        background-color: #3c3c3c;
        color: white;
        font-size: 20px;
        width: 82%;
        height: 50px;
        border: none;
    }

    #boton1 {
        background-color: red;
        color: white;
        font-size: 20px;
        width: 82%;
        height: 50px;
        text-decoration: none;

    }

    #boton1:hover {
        background-color: darkred;
        font-size: 20px;

    }

    #boton:hover {
        background-color: black;
        color: while;
        font-size: 20px;
    }

    #textoerror {
        color: red;
        font-size: 17px;
        font-weight: bold;
    }

    .inputs {
        width: 70%;
        height: 30px;
    }

    .inputs:focus {
        background-color: lightblue;
        color: white;
        font-weight: bold;

    }
</style>

<body>
        <center>
            <div class="caja">
                <h2>Login</h2>
                <?php if (isset($mensaje)) {
                    echo $mensaje;
                } ?>
                <form id="form" action="" method="post">
                    Usuario: <input type="text" name="usuario" class="inputs" required><br>
                    Contraseña: <input type="password" name="contrasena" class="inputs" required><br>
                    <input id="boton" type="submit" value="Iniciar sesión"><br>
                    <a href="aniadirUsuario.php" id="boton1"> registrar</a><br />
                </form>
            </div>
        </center>

    </body>

    </html>