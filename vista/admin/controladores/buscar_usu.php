<?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: ../../../public/vista/login.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buscar</title>
    <style type="text/css">
        .xx{
            background: red;
        }
    </style>
</head>
<body>
  <table>
        <tr id="cabecera">
             <th>Nombres</th>
             <th>Apellidos</th>
             <th>Fecha de Nacimiento</th>
             <th>Correo</th>
             <th>Modificar Datos</th>
             <th>Cambiar</th>
             <th>Eliminar</th
        </tr>
       <?php
            include '../../../config/conexion.php';

            $correo = $_GET['correo'];
            $codigo = $_GET['id'];
                $sql ="SELECT *
                FROM usuarios
                WHERE usu_correo LIKE '%$correo%'";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['usu_nombres'] . "</td>";
                                echo " <td>" . $row['usu_apellidos'] ."</td>";
                                echo " <td>" . $row['usu_fecha_nac'] ."</td>";
                                echo " <td>" . $row['usu_correo'] . "</td>";
                                echo " <td>" . "<a href=perfil.php?idU=".$row['usu_codigo']."&id=".$codigo.">Modificar Datos"."</a>"."</td>";
                                echo " <td>" . "<a href=contrasena.php?idU=".$row['usu_codigo']."&id=".$codigo.">Cambiar Contraseña"."</a>"."</td>";
                                echo " <td>" . "<a href=eliminar.php?idU=".$row['usu_codigo']."&id=".$codigo.">Eliminar"."</a>"."</td>";
                             echo "</tr>";
                         }  

                }else{
                    echo "<tr>";
                        echo "<td colspan='5'>No tiene ningun mensaje en su bandeja de entrada</td>";
                    echo "</tr>";
                }
            
        ?>
    </table>
</body>
</html>