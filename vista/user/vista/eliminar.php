<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="css/styles_perfil.css">
    <link rel="stylesheet" href="css/styles_menu.css">
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
     <form action="../controladores/eliminar_usuario.php" method="post" class="perfil" enctype="multipart/form-data">
       <h1>Eliminar</h1>
       <input type="text" name="codigo" value="<?php echo $codigo?>" hidden="hidden">
       <div class="textbox">
         <input type="text" value="¿Seguro desea eliminar su Cuenta?">
        </div>
        <input class="btn" type="submit" name="Login" value="Seguro">
        <?php
            echo "<a href=perfil.php?id=".$codigo."><input class=btn type=button name=Login value=Cancelar></a>"
        ?>
    </form>
</body>
</html>