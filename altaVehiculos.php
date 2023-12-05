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

    <title>alta vehiculos</title>
</head>
<style>
    .formulario {
        display: grid;
        gap: 30px;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        max-width: 600px;
        margin: auto;
        padding: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        border-radius: 10px;
        overflow: hidden;
        background-color: lightsteelblue;
    }
    h2{
        text-align: center;
        
    }
</style>

<body>

<div class="formulario">
        <h2>Alta de Producto</h2><br>
        <form method="post" action="guardarVehiculo.php" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            <label for="numero_bastidor">numero de bastidor:</label><br>
            <input type="text" id="numero_bastidor" name="numero_bastidor" required><br><br>

            <label for="marca">marca del vehiculo:</label><br>
            <input type="text" id="marca" name="marca" required><br><br>

            <label for="modelo">modelo del vehiculo:</label><br>
            <input type="text" id="modelo" name="modelo" required><br><br>

            <label for="cv_potencia">potencia en caballos:</label><br>
            <input type="number" name="cv_potencia" id="cv_potencia" required><br><br>

            <label for="imgplano">imagen local</label>
            <input type="file" name="imgplano"><br><br>

            <label for="imagen">imagen del vehiculo:</label><br>
            <input type="file" id="imagen" class="btn btn-success" name="imagen"><br><br>

            <label for="precio">precio del vehiculo:</label><br>
            <input type="number" id="precio" name="precio"><br><br>

            <input type="submit" class='btn btn-primary' value="Guardar Producto">
            <input type="reset" class='btn btn-danger' value="Limpiar">
        </form>
    </div>

    <script>
        function validarFormulario() {
            var numeroBastidor = document.getElementById('numero_bastidor').value;
            var marca = document.getElementById('marca').value;
            var modelo = document.getElementById('modelo').value;
            var cvPotencia = document.getElementById('cv_potencia').value;
            var precio = document.getElementById('precio').value;

            if (numeroBastidor === '' || marca === '' || modelo === '' || cvPotencia === '' || precio === '') {
                alert('Por favor, complete todos los campos.');
                return false;
            }

            if (isNaN(cvPotencia) || isNaN(precio)) {
                alert('Los campos de potencia y precio deben ser valores numéricos.');
                return false;
            }

            return true;
        }
    </script>

</body>

</html>