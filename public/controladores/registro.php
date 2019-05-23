<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
   <?php
        include '../../config/conexion.php';
        
        date_default_timezone_set("America/Guayaquil");
    
        $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
        $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]),'UTF-8'): null;
        $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]),'UTF-8'): null;
        $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]): null;
        $fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]): null;
        $contrasena = isset($_POST["password"]) ? trim($_POST["password"]): null;
        $fecha = date("y-m-d h:i:s",time());
    
    
        //subir imagen
    
        $nombre_archivo = $_FILES['imagen']['name'];
        $tipo_archivo = $_FILES['imagen']['type'];
        $tamano_archivo = $_FILES['imagen']['size'];
    
        //ruta carpeta destino en servidor
    
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] .'/Practica-Correo/Practica04-Mi-Correo-Electr-nico/public/vista/images';
    
        
        //mover la imagen del directorio temporal al directorio escogido
    
        move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino."/".$nombre_archivo);
    
        $archivo_objetivo = fopen($carpeta_destino."/". $nombre_archivo,'r');
    
        $contenido=fread($archivo_objetivo,$tamano_archivo);
    
        $contenido = addslashes($contenido);
    
        fclose($archivo_objetivo);
    
        $sql = "INSERT INTO usuarios VALUES (0,'$cedula','$nombres','$apellidos','$correo',MD5('$contrasena'),'$fechaNacimiento','$contenido','$tipo_archivo','N','$fecha',null,2)";
            
        if($conn->query($sql) === TRUE) {
            echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
        } else {
            if($conn->errno == 1062){
                }else{
                    echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
                }
        } 
    
        
    ?>
</body>
</html>