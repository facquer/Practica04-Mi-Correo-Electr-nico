<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambio de Contrseña</title>
    <link rel="stylesheet" href="css/styles_perfil.css">
    <link rel="stylesheet" href="css/styles_menu.css">
    <script type="text/javascript" src="../../../public/controladores/js/validar.js"></script>
</head>
<body>
    <?php
        include '../../../config/conexion.php';
    
        $codigoc = $_GET['id'];
        $sqlc = "SELECT * 
                FROM usuarios
                where usu_codigo = $codigoc";
        $resultc = $conn->query($sqlc);
        $rowc = $resultc->fetch_assoc();
        if($rowc["usu_rol_id"] == 2){
           header("Location: ../../../public/vista/blanco.html"); 
        }
  ?>
    <?php
        
        date_default_timezone_set("America/Guayaquil");
    
        $codigoU = $_GET['idU'];
        $codigo = $_GET['id'];
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
                    echo "<li>"."<a href=usuarios.php?id=".$codigo.">Usuarios</a></li>";
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
              </ul> 
           </nav>
       </div>
   </header>
     <form action="../controladores/update_contrasena.php" method="post" class="perfil">
       <h1>Cambiar</h1>
       <input type="text" name="codigoU" value="<?php echo $codigoU?>" hidden="hidden">
       <input type="text" name="codigo" value="<?php echo $codigo?>" hidden="hidden">
        <div class="textbox" id="cajaP">
         <input type="password" name="password" id="password" value="" placeholder="Escribir nueva contraseña">
         <label for="nombres">Contraseña nueva</label>
        </div>
        <div class="textbox" id="cajaR">
         <input type="password" name="rpassword" id="rpassword" value="" placeholder="repetir nueva contraseña" onkeyup="validarContrasena()">
         <label for="apellido">Repita </label>
        </div>
        <input class="btn" type="submit" name="Login" value="GUARDAR">
    </form>
</body>
</html>