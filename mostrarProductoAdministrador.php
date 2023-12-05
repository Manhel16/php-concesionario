<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['usuario'])) {
    header("location: login.php"); // Redirigir a la página de inicio de sesión
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>mostrar vehiculo indicado</title>
    <style>
         body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #4b6cb7, #182848);
            margin: 0;
        }

        .card {
            max-height: 85%;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 5px;
            margin-top: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="card">
        <?php
        try {
            $conn = new PDO('mysql:host=localhost;dbname=id21519445_vehiculos;charset=utf8', 'id21519445_vehiculosconcesionario', 'Abcd1234!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $stmt = $conn->prepare('SELECT * FROM vehiculos WHERE id = :id');
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $producto = $stmt->fetch();

                // Aquí puedes mostrar la información detallada del producto
                if ($producto) {
                    echo "<h1>Detalles del Producto:</h1>";
                    echo "<p>ID: " . $producto['id'] . "</p>";
                    echo "<p>Número de Bastidor: " . $producto['numero_bastidor'] . "</p>";
                    echo "<p>Marca: " . $producto['marca'] . "</p>";
                    echo "<p>Modelo: " . $producto['modelo'] . "</p>";
                    echo "<p>Caballos de Potencia: " . $producto['caballos_potencia'] . "</p>";
                    echo "<p>Precio: " . $producto['precio'] . "€</p>";
                    echo "<img src='data:image/jpeg;base64," . base64_encode($producto['imagen']) . "'/>". "<br>";
                   
                    // Agregar botón de descarga
                    echo "<a href='data:image/jpeg;base64," . base64_encode($producto['imagen']) . "' download='vehiculo.jpg' class='btn btn-light'>Descargar Imagen</a>";
                } else {
                    echo "No se encontró ningún producto con el ID proporcionado.";
                }
            } else {
                echo "No se proporcionó ningún ID de producto.";
            }
        } catch (PDOException $ex) {
            print "¡Error!: " . $ex->getMessage() . "<br/>";
            exit;
        }
        ?>
        <a href="mostrarVehiculosAdministrador.php" class="btn btn-info">Volver a la tabla</a><br />
    </div>
</body>
</html>