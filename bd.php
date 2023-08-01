
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
$host = "localHost";

//conetamos al base datos
$connection = mysqli_connect($host, $user, $pass);

//hacemos llamado al imput de formuario
$nombre = $_POST["nombre"] ;
$apellido = $_POST["apellido"] ;
$celular = $_POST["celular"] ;
$correo = $_POST["correo"] ;



//verificamos la conexion a base datos
if(!$connection) 
        {
            echo "No se ha podido conectar con el servidor" . mysqli_error ();
        }
  else
        {
            echo "<b><h3>Hemos conectado al servidor</h3></b>" ;
        }
        //indicamos el nombre de la base datos
        $datab = "ecuamaquetas";

         //indicamos selecionar ala base datos
         $db = mysqli_select_db($connection,$datab);

         if (!$db)
         {
         echo "No se ha podido encontrar la Tabla";
         }
         else
         {
         echo "<h3>Tabla seleccionada:</h3>" ;
         }


         
        //insertamos datos de registro al mysql xamp, indicando nombre de la tabla y sus atributos
        $instruccion_SQL = "INSERT INTO cliente (nombre, apellido, celular, correo)
        VALUES ('$nombre','$apellido','$celular', '$correo')";
      
       
$resultado = mysqli_query($connection,$instruccion_SQL);


 //$consulta = "SELECT * FROM tabla where id ='2'"; si queremos que nos muestre solo un registro en especifivo de ID
 $consulta = "SELECT * FROM cliente";
        
 $result = mysqli_query($connection,$consulta);
 if(!$result) 
 {
     echo "No se ha podido realizar la consulta";
 }
 echo "<table>";
 echo "<tr>";
 // echo "<th><h1>id</th></h1>";
 echo "<th><h1>Nombre</th></h1>";
 echo "<th><h1>Apellido</th></h1>";
 echo "<th><h1>Celular</th></h1>";
 echo "<th><h1>Correo</th></h1>";
 echo "</tr>";
 
 while ($colum = mysqli_fetch_array($result))
  {
     echo "<tr>";
     // echo "<td><h2>" . $colum['id']. "</td></h2>";
     echo "<td><h2>" . $colum['nombre']. "</td></h2>";
     echo "<td><h2>" . $colum['apellido'] . "</td></h2>";
     echo "<td><h2>" . $colum['celular'] . "</td></h2>";
     echo "<td><h2>" . $colum['correo'] . "</td></h2>";
   
     echo "</tr>";
 }
 echo "</table>";
 
 mysqli_close( $connection );

 
   //echo "Fuera " ;
   echo'<a href="cotizacion.html"> Volver Atrás</a>';


?>





 