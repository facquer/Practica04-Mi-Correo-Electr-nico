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
    <title>Eliminado</title>
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
    
     $codigo=$_POST['codigo'];
     $fecha = date("y-m-d h:i:s",time());
    
     
     $sql ="UPDATE usuarios
            SET usu_eliminado = 'S',
            usu_fecha_elimina = '$fecha'
            WHERE usu_codigo=$codigo";
    
     if($conn->query($sql)==TRUE){
         echo "<div>";
                    echo "<p class='exito'>El usuario se ha eliminado exitosamente</p>";
                    echo "<a href=cerrar_sesion.php>Volver</a>";
          echo "</div>";
     }else{
         echo "<div>";
                    echo "<p class='exito'>Ocurrio un error</p>";
                    echo "<a href=cerrar_sesion.php>Volver</a>";
         echo "</div>";
     }
   ?>
</body>
</html>