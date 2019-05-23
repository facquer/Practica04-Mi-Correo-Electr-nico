<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href=" ">
    <link rel="stylesheet" href=" ">
</head>
<body>
    <?php
        include '../../../config/conexion.php';
        
         $codigo = $_GET['id'];
         $codigoC = $_GET['id'];
    
         $sql ="SELECT *
                FROM usuarios
                WHERE usu_codigo =$codigo";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
    ?>
    <header class="header">
       <div class="container logo-nav-container">
           <div class="izquierdo">
               <img src="images/logo.png" alt="">
               <h4 id="titulo">Correo</h4>    
           </div>
           <span class="menu-icon">Ver Menu</span>
           <nav class="navegacion">
              <ul class="show">
                  <?php
                    echo "<li>"."<a href=index.php?codigo=".$codigo.">Mensajes</a></li>";
                    echo "<li>"."<a href=usuarios.php?id=".$codigoC.">Usuarios</a></li>";
                  ?>
                  <?php
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
              </ul> 
           </nav>
       </div>
   </header>
     <form action="../controladores/update_perfil.php" method="post" class="perfil" enctype="multipart/form-data">
       <h1>Mi Perfil</h1>
       <input type="text" name="codigo" value="<?php echo $codigo?>" hidden="hidden">
       <div class="textbox" id="textboxImg">
         <?php
            echo "<img class='foto' src='data:".$row['usu_img_extencion']."; base64,".base64_encode($row['usu_imagen'])."'>";
         ?>
         
         <input type='file' name='imagenUpdate' id='imagen' size='20'>
        </div>
        <div class="textbox">
        
         <input type="text" name="nombres" value="<?php echo $row['usu_nombres']?>">
         <label for="nombres">Nombres</label>
        </div>
        <div class="textbox">
         <input type="text" name="apellidos" value="<?php echo $row['usu_apellidos']?>">
         <label for="apellido">Apellidos</label>
        </div>
        <div class="textbox">
         <input type="text" name="fechaNacimiento" value="<?php echo $row['usu_fecha_nac']?>">
         <label for="fechaNacimiento">Nacimiento</label>
        </div>
        <div class="textbox">
         <input type="text" name="correo" value="<?php echo $row['usu_correo']?>">
         <label for="correo">Correo</label>
        </div>
        <input class="btn" type="submit" name="Login" value="GUARDAR">
    </form>
</body>
</html>