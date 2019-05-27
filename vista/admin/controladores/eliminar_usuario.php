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
    <title>Exito</title>
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
    
     $codigoC=$_GET['idU'];
     $codigo=$_GET['id'];
     $fecha = date("y-m-d h:i:s",time());
    
     
     $sql ="UPDATE usuarios
            SET usu_eliminado = 'S',
            WHERE usu_codigo=$codigoC";
    
     if($conn->query($sql)==TRUE){
         echo "<div>";
                    echo "<p class='exito'>El usuario se elimino exitosamente</p>";
                    echo "<a href=../vista/index.php?codigo=".$codigo.">Regresar"."</a>";
          echo "</div>";
     }else{
         echo "<div>";
                    echo "<p class='exito'>Eliminación erronea</p>";
                    echo "<a href=../vista/index.php?codigo=".$codigo.">Regresar"."</a>";
         echo "</div>";
     }
   ?>
</body>
</html>