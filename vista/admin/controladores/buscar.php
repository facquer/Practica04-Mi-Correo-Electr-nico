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
             <th>Fecha del Mensaje</th>
             <th>Remitente</th>
             <th>Destinatario</th>
             <th>Asunto</th>
             <th>Eliminar</th>
        </tr>
       <?php
            include '../../../config/conexion.php';

            $correo = $_GET['correo'];
                $sql ="SELECT *
                FROM correos,
                     usuarios
                WHERE cor_id_usu_remitente=usu_codigo and
                      usu_correo LIKE '%$correo%'
                ORDER BY cor_fec_mensaje";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['cor_fec_mensaje'] . "</td>";
                                echo " <td>" . $row['usu_correo'] ."</td>";
                                echo " <td>" . $row['cor_usu_destino'] ."</td>";
                                echo " <td>" . $row['cor_asunto'] . "</td>";
                                echo " <td>" . "<a href=../controladores/leer_mensaje.php?id=".$row["cor_id"].">Eliminar"."</a>"."</td>";
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