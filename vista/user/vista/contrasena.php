<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambio de Contrseña</title>
    <link rel="stylesheet" href=" ">
    <link rel="stylesheet" href="css/Prueba.css">
    <script type="text/javascript" src="../../../public/controladores/js/validar.js"></script>
</head>
<body>
   <?php
        include '../../../config/conexion.php';
        
         $codigo = $_GET['id'];
    
         $sql ="SELECT *
                FROM usuarios
                WHERE usu_codigo =$codigo";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
    ?>
    <header class="header">
       <div class="container logo-nav-container">
           <div class="izquierdo">
               <img src=" " alt="">
               <h4 id="titulo">Correo</h4>    
           </div>
           <span class="menu-icon">Ver Menu</span>
           <nav class="navegacion">
              <ul class="show">
                  <?php
                    echo "<li>"."<a href=index.php?codigo=".$codigo.">Inicio</a></li>";
                    echo "<li>"."<a href=mensaje.php?id=".$codigo.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=enviados.php?id=".$codigo.">Mensajes Enviados</a></li>";
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
              </ul> 
           </nav>
       </div>
   </header>
     <form action="../controladores/update_contrasena.php" method="post" class="perfil">
       <h1>Cambiar</h1>
       <input type="text" name="codigo" value="<?php echo $codigo?>" hidden="hidden">
        <div class="textbox" id="cajaP">
         <input type="password" name="password" id="password" value="" placeholder="Escribir nueva contraseña">
         <label for="nombres">New</label>
        </div>
        <div class="textbox" id="cajaR">
         <input type="password" name="rpassword" id="rpassword" value="" placeholder="repetir nueva contraseña" onkeyup="validarContrasena()">
         <label for="apellido">Repeat</label>
        </div>
        <input class="btn" type="submit" name="Login" value="GUARDAR">
    </form>
</body>
</html>