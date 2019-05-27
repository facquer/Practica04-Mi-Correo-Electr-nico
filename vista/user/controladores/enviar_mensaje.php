<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        body{          
            background-image: url('../images/fondo.png');
            background-size: cover;
            background-attachment: fixed;
        }
        
        div{
            background: black;
            font-size: 25px;
            display: inline-block;
            text-align: center;
            margin-left: 50vh;
            margin-top: 50vh;
            padding: 0 20px;
            padding-bottom: 25px;
        }
        
        .error{
            color: red;
        }
        
        .exito{
            color: green;
        }
        
        div a{
            text-decoration: none;
            color: white;
            border-style: solid;
            border-color: white;
            border-radius: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
   <?php
        include '../../../config/conexion.php';
        
        date_default_timezone_set("America/Guayaquil");
    
        $remitente = isset($_POST["remitente"]) ? trim($_POST["remitente"]): null;
        $destino = isset($_POST["destino"]) ? trim($_POST["destino"]): null;
        $asunto = isset($_POST["asunto"]) ? trim($_POST["asunto"]): null;
        $mensaje = isset($_POST["mensaje"]) ? trim($_POST["mensaje"]): null;
        $fecha = date("y-m-d h:i:s",time());
    
        $sql ="SELECT *
               FROM usuarios
               WHERE usu_correo = '$destino' AND
                     usu_eliminado ='N'";
            
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        if($row['usu_rol_id'] == 1 || $row['usu_eliminado'] != 'N'){
            echo "<div>";
                echo "<p class='error'>No se Pueden Mandar  mensajes al Administrador o su usuario esta inactivo</p>";
                echo "<a href=../vista/mensaje.php?id=".$remitente.">Volver"."</a>";
            echo "</div>";
        }else{
            $sql_1 ="INSERT INTO correos VALUES (0,'$fecha','$asunto','$mensaje','NULL','N','NULL','$destino',$remitente)";
            if($conn->query($sql_1) === TRUE){
                echo "<div>";
                    echo "<p class='exito'>Mensaje Enviado Correctamente a ".$destino."</p>";
                    echo "<a href=../vista/mensaje.php?id=".$remitente.">Volver"."</a>";
                echo "</div>";
            }else{
                echo "<div>";
                    echo "<p class='error'>Error al Enviar el Mensaje</p>";
                    echo "<a href=../vista/mensaje.php?id=".$remitente.">Volver"."</a>";
                echo "</div>";
            }
        }
    ?>
</body>
</html>