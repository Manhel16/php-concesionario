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

    <title>mostrar vehiculos administrador</title>
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
    }


    .modificar-formulario {
        padding: 3px;
        margin: 5px;
        display: flex;
        align-items: center;
        justify-content: space-around;
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
    <?php
    try {
        $conn = new PDO('mysql:host=localhost;dbname=id21519445_vehiculos;charset=utf8', 'id21519445_vehiculosconcesionario', 'Abcd1234!');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_GET['delete'])) {
            $codigo_a_eliminar = $_GET['delete'];
            $stmt = $conn->prepare('DELETE FROM vehiculos WHERE id = :id');
            $stmt->bindParam(':id', $codigo_a_eliminar);
            $stmt->execute();
        }
        $stmt = $conn->prepare('SELECT * FROM vehiculos order by id');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        print "¡Error!: " . $ex->getMessage() . "<br/>";
        exit;
    }
    ?>


    <div id="contenedor">
        <h3>Todos los vehiculos</h3>
        <table border=1>
            <tr id="estilo_cabecera">
                <th>ID</th>
                <th>NUMERO BASTIDOR</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Caballos de Potencia</th>
                <th>imagen local</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th colspan="3">Acciones</th>
            </tr>

            <?php
            while ($prove = $stmt->fetch()) {
                $id = $prove['id'];
                echo "<tr>";
                echo "<td>" . $prove['id'] . "</td><td>" . $prove['numero_bastidor'] . "</td><td>" . $prove['marca'] .
                "</td><td>" . $prove['modelo'] . "</td><td>" . $prove['caballos_potencia'] ."</td><td>". "<img src='" . $prove['imgplano'] . "' alt='". $prove['marca']  ."'></td><td><img src='data:image/jpeg;base64," . base64_encode($prove['imagen']) . "'/> </td><td>" . $prove['precio'] . "€ </td>" .
                "<td><button onclick='mostrarForm(\"form$id\")' class='btn btn-primary'>Modificar</button></td>" .
                "<td><a href='?delete=" . $id . "' class='btn btn-danger'>Eliminar</a></td>" . "<td><a href='vehiculo/$id' class='btn btn-info'>Ver Detalles</a></td>" ;
            
                echo "</tr>";

                echo "<tr style='display:none' id='form$id'>";
                echo "<td colspan='8'>
            <form method='post' class='modificar-formulario'>
                <input type='hidden' name='id' value='" . $id . "'>
                <input type='text' name='marca' placeholder='Nueva marca' >
                <input type='text' name='modelo' placeholder='Nuevo modelo' >
                <input type='number' name='caballos_potencia' placeholder='Nuevos caballos de potencia'>
                <input type='number' name='precio' placeholder='Nuevo precio'>
                <input type='submit' name='modificar' class='btn btn-primary' value='Modificar'>
            </form>
        </td>";
                echo "</tr>";

                if (isset($_POST['modificar'])) {
                    $id_modificar = $_POST['id'];
                    $query = 'UPDATE vehiculos SET ';
                    $params = array();

                    if (!empty($_POST['marca'])) {
                        $query .= 'marca = :marca, ';
                        $params[':marca'] = $_POST['marca'];
                    }
                    if (!empty($_POST['modelo'])) {
                        $query .= 'modelo = :modelo, ';
                        $params[':modelo'] = $_POST['modelo'];
                    }
                    if (!empty($_POST['caballos_potencia'])) {
                        $query .= 'caballos_potencia = :caballos, ';
                        $params[':caballos'] = $_POST['caballos_potencia'];
                    }
                    if (!empty($_POST['precio'])) {
                        $query .= 'precio = :precio, ';
                        $params[':precio'] = $_POST['precio'];
                    }

                    $query = rtrim($query, ', ');

                    $query .= ' WHERE id = :id';
                    $params[':id'] = $id_modificar;

                    $stmt = $conn->prepare($query);
                    foreach ($params as $key => &$value) {
                        $stmt->bindParam($key, $value);
                    }
                    $stmt->execute();

                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
            ?>

        </table>

        <script>
            function mostrarForm(id) {
                var form = document.getElementById(id);
                if (form.style.display === 'none') {
                    form.style.display = 'table-row';
                } else {
                    form.style.display = 'none';
                }
            }
        </script>
        <a href="altaVehiculos.php" id="boton" class='btn btn-primary'>Nuevo vehiculo</a>
        <a href="cerrarSesion.php" id="boton" class="btn btn-info">Cerrar Sesión</a><br />
    </div>



</body>

</html>