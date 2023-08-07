<?php
// Validamos datos del servidor
$user = "root";
$pass = "";
$host = "localhost";
$dbname = "cliente";

// Conectamos a la base de datos
$connection = mysqli_connect($host, $user, $pass, $dbname);

// Verificamos la conexión a la base de datos
if (!$connection) {
    die("No se ha podido conectar con el servidor: " . mysqli_error());
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
    
    // Preparamos la consulta SQL para insertar los datos en la tabla "cliente"
    $sql = "INSERT INTO cliente (nombre, apellido, ciudad, correo, celular, fecha, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        echo "Error al preparar la consulta: " . $connection->error;
    } else {
        // Enlazamos los parámetros a la consulta
        $stmt->bind_param('sssssss', $nombre, $apellido, $ciudad, $correo, $celular, $fecha, $descripcion);
        // Ejecutamos la consulta
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar los datos: " . $stmt->error;
        }

        // Cerrar el statement
        $stmt->close();
    }

    // Consultamos todos los registros de la tabla "cliente"
    $consulta = "SELECT * FROM cliente";
    $resultado = mysqli_query($connection, $consulta);

    // Comprobar si la consulta SELECT fue exitosa
    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            echo "<h3>Resultados:</h3>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Ciudad</th><th>Celular</th><th>Correo</th><th>Fecha</th><th>Descripción</th></tr>";
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["ciudad"] . "</td>";
                echo "<td>" . $row["celular"] . "</td>";
                echo "<td>" . $row["correo"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>0 resultados</p>";
        }
    } else {
        echo "Error al realizar la consulta: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>