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
    <title>Perfil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="  ">
    <link rel="stylesheet" href="css/stylesGeneral.css">
    <script type="text/javascript" src="../controladores/ajax.js"></script>
</head>
<body>
 <?php
        include '../../../config/conexion.php';
    
        $codigoc = $_GET['codigo'];
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
    $codigo = $_GET['codigo'];
   ?>
   <header class="header">
       <div class="header header-wrap-one">
           <div class="container cf">
           <h1 class="logo"><a href="#">CORREO</a></h1>
           <div class="menu-toggle">Menu</div>
           <div class="navigation">
              <ul>
                  <li><a href="#">Inicio</a></li>
                  <?php
                    echo "<li>"."<a href=mensaje.php?id=".$codigo.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=enviados.php?id=".$codigo.">Mensajes Enviados</a></li>";
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                    //echo "<li>"."<img class='fotito' id='prueba' src='data:".$rowc['usu_img_extencion']."; base64,".base64_encode($rowc['usu_imagen'])."'>".$rowc['usu_nombres']." ".$rowc['usu_apellidos']." </li>";
                  ?>
                  
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>
            </div>

   </header>
   <main class="align">
    <section class="mail">
        <h1>Inicio</h1><br>
            <form action="" class="busqueda">
                <input type="text"  id="remite" name="remitente" value="<?php echo $codigo?>" hidden="hidden">
                <input type="text" name="correo" placeholder="buscar por remitente" id="correo" value="" onkeyup="buscarPorCorreo()">
            </form>
        <br>
        <div id="informacion">
            <table id="estilo">
            <thead>
                <tr>
                    <th>Fecha del Mensaje</th>
                    <th>Remitente</th>
                    <th>Asunto</th>
                    <th>Opcion</th>
                </tr>
            </thead>
            <?php
                $codigo = $_GET['codigo'];

                $sql ="SELECT *
                FROM correos,
                     usuarios
                where cor_id_usu_remitente = usu_codigo AND
                cor_usu_destino = (SELECT usu_correo FROM usuarios WHERE
                                    usu_codigo = $codigo)
                ORDER BY cor_fec_mensaje";


                $result = $conn->query($sql);
                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['cor_fec_mensaje'] . "</td>";
                                echo " <td>" . $row['usu_correo'] ."</td>";
                                echo " <td>" . $row['cor_asunto'] . "</td>";
                                echo " <td>" . "<a href=../controladores/leer_mensaje.php?id=".$row["cor_codigo"]."&id_usu=".$row["cor_id_usu_remitente"]."&id_des=".$codigo.">Leer Mensaje"."</a>". "</td>";
                             echo "</tr>";
                         }  
                }else{
                    echo "<tr>";
                        echo "<td colspan='4'>No tiene ningun mensaje en su bandeja de entrada</td>";
                    echo "</tr>";
                }
            ?>
        </table>
        </div> 
    </section>
   </main> 
</body>
</html>