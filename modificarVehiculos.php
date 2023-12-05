<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- <?php
            // if (isset($_POST["id"])) {
            //     $numero_bastidor = $_POST['numero_bastidor'];
            //     $marca = $_POST['marca'];
            //     $modelo = $_POST['modelo'];
            //     $caballos_potencia = $_POST['caballos_potencia'];
            //     $precio = $_POST['precio'];



            //     try {
            //         $conn = new PDO('mysql:host=localhost;dbname=Vehiculos;charset=utf8', 'root', '');
            //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //         $stmt = $conn->prepare('UPDATE vehiculos SET numero_bastidor = :numero_bastidor, marca = :marca, modelo = :modelo, caballos_potencia = :caballos_potencia, precio = :precio  WHERE id = :id');
            //         $stmt->bindParam(':id', $_POST['id']); // Aquí utilizamos directamente $_POST['id']
            //         $stmt->bindParam(':marca', $marca);
            //         $stmt->bindParam(':modelo', $modelo);
            //         $stmt->bindParam(':numero_bastidor', $numero_bastidor);
            //         $stmt->bindParam(':caballos_potencia', $caballos_potencia);
            //         $stmt->bindParam(':precio', $precio);
            //         $stmt->execute();

            //         header('Location: mostrarVehiculosAdministrador.php'); // Redirige a la página que muestra todos los vehículos

            //     } catch (PDOException $ex) {
            //         print "¡Error!: " . $ex->getMessage() . "<br/>";
            //         exit;
            //     }
            // } else {
            //     if (isset($_GET['id'])) {
            //         $id = $_GET['id'];
            //     }
            // }
            // 
            ?>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="numero_bastidor">numero bastidor</label>
        <input type="text" name="numero_bastidor" value="<?php echo $numero_bastidor ?>"> <br> <br>
        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="<?php echo $marca; ?>"><br><br>
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" value="<?php echo $modelo; ?>"><br><br>
        <label for="caballos_potencia">caballos:</label>
        <input type="number" name="caballos_potencia" value="<?php echo $caballos_potencia ?>"><br><br>
        <label for="precio">precio</label>
        <input type="number" name="precio" value="<?php echo $precio ?>"><br><br>
        <input type="submit" value="Actualizar">
    </form> -->
    <h1 id="titulo">Modificar un Vehiculo</h1>

    <div class="contenedor">
        <form action="" method="post">
            <p>Qué quieres modificar:</p>
            <select name="datos" id="datos">
                <option value="marca">marca</option>
                <option value="modelo">modelo</option>
                <option value="caballos">caballos_potencia</option>
                <option value="precio">precio</option>
            </select>
            <p>Introduce el cambio: </p>
            <input type="text" name="nuevo" id="nuevo" required>
            <input type="submit" name="enviar" value="Modificar">
        </form>
    </div>

    <?php
if (isset($_POST['enviar'])) {
    $id = $_GET['id'];
    $dato = $_POST['datos'];
    $nuevo = $_POST['nuevo'];
    
    try {
        $conn = new PDO('mysql:host=localhost;dbname=Vehiculos;charset=utf8', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE vehiculos SET $dato = :nuevo WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nuevo', $nuevo);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    header('location: mostrarVehiculosAdministrador.php');
}
?>


    <a href="mostrarVehiculosAdministrador.PHP" id="volver">← Volver</a>



</body>

</html>