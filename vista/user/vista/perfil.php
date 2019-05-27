<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/stylesGeneral.css">
    <link rel="stylesheet" href="css/stylesLogin.css">
    <style type="text/css">
        #link{
            text-decoration: none;
            background: none;
            color: white;
            font-size: 20px;
            margin: 8px 0;
            padding: 5px;
            cursor: pointer;
            border-bottom: 1px solid white;
            display: block;  
        }
        
        #link:hover{
            cursor: pointer;
            color: greenyellow;
        }
    </style>
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
                  ?>
                  <li><a href="">Mi Cuenta</a></li>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>
            </div>

   </header>
     <form action="../controladores/update_perfil.php" method="post" class="form login" enctype="multipart/form-data">
        <header class="login_cabezera">
            <h3 class="login_titulo">Mi Cuenta</h3>
        </header>
        <div class="login_centro">
            <input type="text" name="codigo" value="<?php echo $codigo?>" hidden="hidden">
            <div class="form__field">
            <?php
                echo "<img class='foto' src='data:".$row['usu_img_extencion']."; base64,".base64_encode($row['usu_imagen'])."'>";
            ?>
            
            <input type='file' name='imagenUpdate' id='imagen' size='20'>
            </div>
            <div class="form__field">
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" value="<?php echo $row['usu_nombres']?>">
            </div>
            <div class="form__field">
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $row['usu_apellidos']?>">
            </div>
            <div class="form__field">
            <label for="cedula">Cedula</label>
            <input type="text" name="cedula" value="<?php echo $row['usu_cedula']?>">
            </div>
            <div class="form__field">
            <label for="fechaNacimiento">Nacimiento</label>
            <input type="text" name="fechaNacimiento" value="<?php echo $row['usu_fecha_nac']?>">
            </div>
            <div class="form__field">
            <label for="correo">Correo</label>
            <input type="text" name="correo" value="<?php echo $row['usu_correo']?>">
            </div>
        </div>
        <footer class="login_ingresar">
            <?php
                echo "<a id=link href=contrasena.php?id=".$codigo.">Cambiar Contraseña</a>";
            ?>
            <?php
                echo "<a id=link href=eliminar.php?id=".$codigo.">Eliminar Usuario</a>";
            ?>
            <input class="btn" type="submit" name="Login" value="GUARDAR">
        </footer>
    </form>
</body>
</html>