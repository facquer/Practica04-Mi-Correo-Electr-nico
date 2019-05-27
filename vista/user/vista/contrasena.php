<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambio de Contrseña</title>
    <link rel="stylesheet" href="css/stylesGeneral.css">
    <link rel="stylesheet" href="css/stylesLogin.css">
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
       <div class="header header-wrap-one">
           <div class="container cf">
           <h1 class="logo"><a href="#">CORREO</a></h1>
           <div class="menu-toggle">Menu</div>
           <div class="navigation">
              <ul>
              <?php
                    echo "<li>"."<a href=index.php?codigo=".$codigo.">Inicio</a></li>";
                    echo "<li>"."<a href=mensaje.php?id=".$codigo.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=enviados.php?id=".$codigo.">Mensajes Enviados</a></li>";
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>
            </div>

   </header>
     <form action="../controladores/update_contrasena.php" method="post" class="form login">
        <header class="login_cabezera">
            <h3 class="login_titulo">Cambiar contraseña</h3>
        </header>
        <div class="login_centro">
        <input type="text" name="codigo" value="<?php echo $codigo?>" hidden="hidden">
            <div class="form__field">
            <label for="nombres">Contraseña nueva</label>
            <input type="password" name="password" id="password" value="" placeholder="Escribir nueva contraseña">
            </div>
            <div class="form__field">
            <label for="apellido">Repita</label>
            <input type="password" name="rpassword" id="rpassword" value="" placeholder="repetir nueva contraseña" onkeyup="validarContrasena()">
            </div>
        </div>
        <footer class="login_ingresar">
            <input class="btn" type="submit" name="Login" value="GUARDAR">
        </footer>
    </form>
</body>
</html>