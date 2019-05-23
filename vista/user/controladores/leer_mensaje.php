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
    <title>Mensaje</title>
    <link rel="stylesheet" href="  ">
    <link rel="stylesheet" href="  ">
</head>
<body>
    <?php
        include '../../../config/conexion.php';
    
        $codigoc = $_GET['id_des'];
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
    
        include '../../../config/conexion.php';
        
        $codigo=$_GET["id"];
        $codigoU=$_GET["id_usu"];
        $codigoD=$_GET["id_des"];
    
        $sql ="SELECT *
        FROM correos,
             usuarios
        WHERE cor_codigo=$codigo and
              cor_id_usu_remitente = usu_codigo";
    
        
    
        $result=$conn->query($sql);
        $row = $result->fetch_assoc();
    
        $sqlu ="SELECT *
               FROM usuarios
               WHERE usu_codigo=$codigoU";
    
        $resultu=$conn->query($sqlu);
        $rowu = $resultu->fetch_assoc();
        
    ?>
    
    <header class="header">
       <div class="container logo-nav-container">
           <div class="izquierdo">
               <img src="../vista/images/logo.png" alt="">
               <h4 id="titulo">Mail.com</h4>    
           </div>
           <span class="menu-icon">Ver Menu</span>
           <nav class="navegacion">
              <ul class="show">
                  <?php
                    echo "<li>"."<a href=../vista/index.php?codigo=".$codigoD.">Inicio</a></li>";
                    echo "<li>"."<a href=../vista/mensaje.php?id=".$codigoD.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=../vista/enviados.php?id=".$codigoD.">Enviados</a></li>";
                    echo "<li>"."<a href=../vista/perfil.php?id=".$codigoD.">Mi Cuenta</a></li>";
                  ?>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
              </ul> 
           </nav>
       </div>
    </header>
    
    
    <form action="" class="mensaje" enctype="multipart/form-data">
        <div>
            <?php 
             echo "<img class='foto' src='data:".$row['usu_img_extencion']."; base64,".base64_encode($row['usu_imagen'])."'>";
            ?>
        </div>
        <div class="textbox">
            <label for="titulo" class="titulo_m">Remitente Del Mensaje:</label>
            <label for="titulo" class="relleno"><?php echo $rowu["usu_correo"]?></label>
            <br>
        </div>
        <div class="textbox">
            <label for="asunto" class="titulo_m">Asunto:</label>
            <label for="asunto" class="relleno"><?php echo $row["cor_asunto"]?></label>
        </div>
        <div class="textbox">
            <p id="mensaje_correo"><?php echo $row["cor_mensaje"]?></p>
        </div>
    </form>
    
</body>
</html>