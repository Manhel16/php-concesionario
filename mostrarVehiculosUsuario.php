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

    <title>mostrar vehiculos usuario normal</title>
</head>
<style>
    body {
        background-image: url(img/fondo\ concesionario.jpeg);
        background-size: cover;
        height: 100%;
        background-repeat: no-repeat;
    }

    table {
        width: 80%;
        padding: 3px;
        margin: 5px;
        text-align: center;
        justify-content: center;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    table::before,
    table::after {
        content: '';
        position: absolute;
        border: 1px solid black;
        top: 0;
        bottom: 0;
        width: 10px;
    }

    table::before {
        left: 0;
        border-right: none;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    table::after {
        right: 0;
        border-left: none;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    td,
    th {
        border: 2px solid black;
    }

    h3 {
        color: black;
        font-size: 50px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        align-items: center;
        display: flex;
        justify-content: center;
        text-shadow:
            -1px -1px 0 #fff,
            1px -1px 0 #fff,
            -1px 1px 0 #fff,
            1px 1px 0 #fff;

    }

    #estilo_cabecera {
        padding: 30px;
    }

    #contenedor {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100%;
    }

    a {
        margin: 20px;
    }

    img {
        max-height: 100px;
        max-width: 100px;
    }

    #boton {
        justify-content: center;
    }

    th {
        background-color: red;
        color: white;
        padding:5px;
    }

    td {
        padding: 17px;
    }



    input[type='text'],
    input[type='number'] {
        width: 20%;
        height: 40px;
        background-color: lightcyan;
        color: black;
        border: none;
        font-size: 14px;
        font-weight: bold;
    }
</style>

<body>
    <div id="contenedor">
        <h3>Relación de Proveedores</h3>
        <table border=1>
            <tr id="estilo_cabecera">
                <th>ID</th>
                <th>NUMERO BASTIDOR</th>
                <th>marca</th>
                <th>MODELO</th>
                <th>CABALLOS DE POTENCIA</th>
                <th>IMAGEN LOCAL</th>
                <th>IMAGEN</th>
                <th>PRECIO</th>
                <th>ACCIONES</th>
            </tr>

            <?php
            try {
                $conn = new PDO('mysql:host=localhost;dbname=id21519445_vehiculos;charset=utf8', 'id21519445_vehiculosconcesionario', 'Abcd1234!');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //  echo "Conexión realizada con éxito !!! <br/>";

                $stmt = $conn->prepare('SELECT * FROM vehiculos order by id');
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($prove = $stmt->fetch()) {
                    // print_r($prove); 
                    $cif = $prove['id'];
                    echo "<tr>";
                    echo "<tr>";
                    echo "<td>" . $prove['id'] . "</td><td>" . $prove['numero_bastidor'] . "</td><td>" . $prove['marca'] .
                "</td><td>" . $prove['modelo'] . "</td><td>" . $prove['caballos_potencia'] ."</td><td>". "<img src='" . $prove['imgplano'] . "' alt='". $prove['marca']  ."'></td><td><img src='data:image/jpeg;base64," . base64_encode($prove['imagen']) . "'/> </td><td>" . $prove['precio'] . "€ </td>"."<td><a href='mostrarProducto.php?id=" . $prove['id'] . "' class='btn btn-info'>Ver Detalles</a></td>";
;

                    echo "</tr>";
                }
            } catch (PDOException $ex) {
                print "¡Error!: " . $ex->getMessage() . "<br/>";
                exit;
            }
            ?>

        </table>
        <a href="cerrarSesion.php" id="boton" class="btn btn-info">cerrar Sesion</a><br />
    </div>
</body>

</html>