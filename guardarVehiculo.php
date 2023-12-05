<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar vehiculo</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeroBastidor = $_POST['numero_bastidor'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $cv_potencia = $_POST['cv_potencia'];
        $precio = $_POST['precio'];

        // Directorio donde se guardará la imagen
        $nombreDirectorio = "imagenesSubidas/";

        // Ruta completa de la imagen
        $imgplano = $_FILES['imgplano']['name'];
        $directorioCompleto = $nombreDirectorio . $imgplano;

        // Mueve la imagen a la ubicación deseada
        move_uploaded_file($_FILES['imgplano']['tmp_name'], $directorioCompleto);

        // Convierte la imagen a un formato adecuado para la base de datos
        $imagen = file_get_contents($directorioCompleto);

        try {
            $conn = new PDO('mysql:host=localhost;dbname=id21519445_vehiculos;charset=utf8', 'id21519445_vehiculosconcesionario', 'Abcd1234!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Realizar la inserción en la base de datos
            $stmt = $conn->prepare('INSERT INTO vehiculos (numero_bastidor, marca, modelo, caballos_potencia, imgplano, imagen, precio) VALUES (:numeroBastidor, :marca, :modelo, :cv_potencia, :imgplano, :imagen, :precio)');
            $stmt->bindParam(':numeroBastidor', $numeroBastidor);
            $stmt->bindParam(':marca', $marca);
            $stmt->bindParam(':modelo', $modelo);
            $stmt->bindParam(':cv_potencia', $cv_potencia);
            $stmt->bindParam(':imgplano', $directorioCompleto);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB); // Usa PDO::PARAM_LOB para datos BLOB
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();

            // Mostrar los datos del producto creado
            echo "Producto creado con éxito:<br>";
            echo "Numero de bastidor: " . $numeroBastidor . "<br>";
            echo "Marca: " . $marca . "<br>";
            echo "Modelo: " . $modelo . "<br>";
            echo "Caballos de potencia: " . $cv_potencia . "<br>";
            echo "Precio: " . $precio . "<br>";

            // Agregar un enlace para mostrar la tabla de productos
            echo "<a href='mostrarVehiculosAdministrador.php'>Ver listado de productos</a>";
        } catch (PDOException $ex) {
            echo "¡Error!: " . $ex->getMessage() . "<br/>";
            exit;
        }
    } else {
        echo "Error: Acceso no válido.";
    }
    ?>

</body>

</html>