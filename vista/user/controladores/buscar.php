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
</head>
<body>
  <table id="estilo">
        <thead>
        <tr id="cabecera">
             <th>Fecha del Mensaje</th>
             <th>Remitente</th>
             <th>Asunto</th>
             <th>Opcion</th>
        </tr>
</thead>
       <?php
            include '../../../config/conexion.php';

            $correo = $_GET['correo'];
            $id = $_GET['id'];
            $sql ="SELECT *
                FROM correos,
                     usuarios
                WHERE cor_id_usu_remitente = usu_codigo AND
                cor_usu_destino = (SELECT usu_correo FROM usuarios WHERE
                                    usu_codigo = $id) AND
                usu_correo like '%$correo%'";

                $result = $conn->query($sql);

                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['cor_fec_mensaje'] . "</td>";
                                echo " <td>" . $row['usu_correo'] ."</td>";
                                echo " <td>" . $row['cor_asunto'] . "</td>";
                                echo " <td>" . "<a href=../controladores/leer_mensaje.php?id="."&id_usu=".$row["cor_id_usu_remitente"].">Leer Mensaje"."</a>". "</td>";
                             echo "</tr>";
                         }  

                }else{
                     echo "<tr>";
                        echo "<td colspan='5'>No existe el usuario en el sistema</td>";
                    echo "</tr>";
                }       
            
        ?>
    </table>
</body>
</html>