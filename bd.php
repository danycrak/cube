
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENERAR ORDEN</title>
    <style type="text/css">
     
      table {
        border: solid 2px #7e7c7c;
        border-collapse: collapse;
                     
      }
     
      th, h1 {
        background-color: #edf797;
      }

      td,
      th {
        border: solid 1px #7e7c7c;
        padding: 2px;
        text-align: center;
      }


    </style>
</head>
</head>

<body>
    <h1>GENERAR ORDEN</h1>
    <table>
        <tr>
            <th>Columna 1</th>
            <th>Columna 2</th>
        </tr>
        <tr>
            <td>Dato 1</td>
            <td>Dato 2</td>
        </tr>
    </table>
</body>
</html>



<?php
//validamos datos del servidor
$user = "root";
$pass = "Monse2025";
$host = "localhost";
$dbname = "ecuamaquetas";

// Conectamos a la base de datos
$connection = mysqli_connect($host, $user, $pass, $dbname);

// Verificamos la conexión a la base de datos
if (!$connection) {
    die("No se ha podido conectar con el servidor: " . mysqli_error());
} else {
    echo "<b><h3>Hemos conectado al servidor</h3></b>";
}

// Verificamos la existencia de la tabla "cliente" en la base de datos
$db = mysqli_select_db($connection, $dbname);
if (!$db) {
    echo "No se ha podido encontrar la tabla";
} else {
    echo "<h3>Tabla seleccionada:</h3>";
}

// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos los valores del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $ciudad = $_POST["ciudad"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];



// Preparar y ejecutar la consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO tabla_datos (nombre, apellido, ciudad, celular, correo, fecha, descripcion)
VALUES (:nombre, :apellido, :ciudad, :celular, :correo, :fecha, :descripcion)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->bindParam(':ciudad', $ciudad);
$stmt->bindParam(':celular', $celular);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':fecha', $fecha);
$stmt->bindParam(':descripcion', $descripcion);
$stmt->execute();






    // Insertamos los datos de registro en la tabla "cliente"
    $instruccion_SQL = "INSERT INTO cliente (nombre, apellido, cuidad, celular, correo, fecha, descripcion)
                       VALUES ('$nombre','$apellido','$ciudad''$celular', '$correo', '$fecha', '$descripcion')";

    $resultado = mysqli_query($connection, $instruccion_SQL);

    if ($resultado) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar los datos: " . mysqli_error($connection);
    }
}

// Consultamos todos los registros de la tabla "cliente"
$consulta = "SELECT * FROM cliente";
$result = mysqli_query($connection, $consulta);
if (!$result) {
    echo "No se ha podido realizar la consulta";
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "" . $row["id"] . "nombre" . $row["nombre"] . " apellido " . $row["apellido"] ." ciudad " . $row["ciudad"] . " Celular " . $row["celular"] . "Correo " . $row["correo"] . "Fecha" . $row["fecha"]." Decripcion" . $row["descripcion"] . "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

mysqli_close($connection);
?>