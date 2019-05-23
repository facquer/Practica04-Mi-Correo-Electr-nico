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
            background-image: url(../vista/images/fondo.jpg);
            background-size: cover;
        }
        
        div{
            background: rgba(0,0,0,0.8);
            font-size: 25px;
            display: inline-block;
            font-family: sans-serif;
            text-align: center;
            margin-left: 74vh;
            margin-top: 50vh;
            padding: 0 20px;
            padding-bottom: 25px;
        }
        
        .error{
            color: crimson;
        }
        
        .exito{
            color: greenyellow;
        }
        
        div a{
            text-decoration: none;
            color: white;
            font-family: sans-serif;
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
    
     $codigoU=$_POST['codigoU'];
     $codigo = $_POST['codigo'];
     $contrasena = isset($_POST["rpassword"]) ? trim($_POST["rpassword"]): null;
     $fecha = date("y-m-d h:i:s",time());
    
     
     $sql ="UPDATE usuarios
            SET usu_password = MD5('$contrasena'),
                usu_fecha_modificacion = '$fecha'
            WHERE usu_codigo=$codigoU";
    
     if($conn->query($sql)==TRUE){
         echo "<div>";
                    echo "<p class='exito'>La Contraseña se actualizo exitosamente </p>";
                    echo "<a href=../vista/usuarios.php?id=".$codigo.">Regresar"."</a>";
          echo "</div>";
     }else{
         echo "<div>";
                    echo "<p class='exito'>Actualización erronea</p>";
                    echo "<a href=../vista/index.php?codigo=".$codigo.">Regresar"."</a>";
         echo "</div>";
     }
   ?>
</body>
</html>