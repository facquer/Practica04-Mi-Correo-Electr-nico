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
    <title>Nuevo mensaje</title>
    <link rel="stylesheet" href="  ">
    <link rel="stylesheet" href="  ">
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
        if($rowc["usu_rol_id"] == 1){
           header("Location: ../../../public/vista/blanco.html"); 
        }
    ?>
    <?php
        
        $codigo = $_GET['id'];
    
        $sql = "SELECT * 
                FROM usuarios 
                where usu_codigo = $codigo";
        
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
                    echo "<li>"."<a href=index.php?codigo=".$codigo.">Inicio</a></li>";
                  ?>
                  <li><a href="#">Nuevo Mensaje</a></li>
                  <?php
                    echo "<li>"."<a href=enviados.php?id=".$codigo.">Mensajes Enviados</a></li>";
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
              </ul> 
           </nav>
       </div>
   </header>
   <form action="../controladores/enviar_mensaje.php" method="post">
       <h2 id="titulo_contactos">MENSAJE</h2>
        <input type="text"  id="remite" name="remitente" value="<?php echo $codigo?>" hidden="hidden">
        <input type="text" name="destino" placeholder="Ingrese a que correo desea enviar" value='@ups.edu.ec'>
        <input type="text" name="asunto" placeholder="Asunto del Mensaje">
        <textarea name="mensaje"  cols="30" rows="10" placeholder="Escriba aqui su mensaje"></textarea>
        <input type="submit" value="ENVIAR" id="boton">
   </form>
</body>
</html>