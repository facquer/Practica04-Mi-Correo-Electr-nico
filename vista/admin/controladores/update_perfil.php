<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exito</title>
    <style type="text/css">
        body{
            background-image: url( );
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

        $codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]): null;
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
        $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]),'UTF-8'): null;
        $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]),'UTF-8'): null;
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]): null;
        $fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]): null;
        $fecha = date("y-m-d h:i:s",time());

        //subir imagen
    
        $nombre_archivo = $_FILES['imagenUpdate']['name'];
        $tipo_archivo = $_FILES['imagenUpdate']['type'];
        $tamano_archivo = $_FILES['imagenUpdate']['size'];
    
        //ruta carpeta destino en servidor
    
          $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] .'/Practica-Correo/Practica04-Mi-Correo-Electr-nico/public/vista/images';
    
        
        //mover la imagen del directorio temporal al directorio escogido
    
        move_uploaded_file($_FILES['imagenUpdate']['tmp_name'],$carpeta_destino."/".$nombre_archivo);
    
        $archivo_objetivo = fopen($carpeta_destino."/". $nombre_archivo,'r');
    
        $contenido=fread($archivo_objetivo,$tamano_archivo);
    
        $contenido = addslashes($contenido);
    
        fclose($archivo_objetivo);
    
        $sql ="UPDATE usuarios
            SET usu_cedula='$cedula',
 	            usu_nombres = '$nombres',
	            usu_apellidos = '$apellidos',
                usu_correo = '$correo',
                usu_fecha_nac='$fechaNacimiento',
                usu_imagen ='$contenido',
                usu_img_extencion = '$tipo_archivo',
                usu_fecha_modificacion = '$fecha'
                WHERE usu_codigo = $codigo";
    
        if($conn->query($sql) === TRUE) {
             echo "<div>";
                    echo "<p class='exito'>Su Actualización de datos termino exitosa</p>";
                    echo "<a href=../vista/perfil.php?id=".$codigo.">Regresar"."</a>";
                echo "</div>";
        } else {
             echo "<div>";
                    echo "<p class='exito'>Actualización erronea</p>";
                    echo "<a href=../vista/perfil.php?id=".$codigo.">Regresar"."</a>";
                echo "</div>";
        }
    ?>
</body>
</html>
