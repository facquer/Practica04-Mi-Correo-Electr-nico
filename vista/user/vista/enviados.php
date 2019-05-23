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
    <title>Mensajes Enviados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="  ">
    <link rel="stylesheet" href="  ">
    <script type="text/javascript" src="../controladores/ajax.js"></script>
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
                    echo "<li>"."<a href=mensaje.php?id=".$codigo.">Nuevo Mensaje</a></li>";
                    echo "<li>"."<a href=#".">Mensajes Enviados</a></li>";
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
              </ul> 
           </nav>
       </div>
   </header>
   <main class="main">
    <section class="mail">
            <form action="" class="busqueda">
                <input type="text"  id="remite" name="remitente" value="<?php echo $codigo?>" hidden="hidden">
                <input type="text" name="correo" placeholder="buscar por remitente" id="correo" value="" onkeyup="buscarPorCorreo()">
            </form>
        <br>
        <div id="informacion">
            <table>
            <tr id="cabecera">
                <th>Fecha del Mensaje</th>
                <th>Destinatario</th>
                <th>Asunto</th>
                <th>Opcion</th>
            </tr>
            <?php
                $codigo = $_GET['id'];
                $sql ="SELECT *
                FROM correos,
                     usuarios
                where cor_id_usu_remitente = usu_codigo AND 
                cor_id_usu_remitente = $codigo
                ORDER BY cor_fec_mensaje";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['cor_fec_mensaje'] . "</td>";
                                echo " <td>" . $row['cor_usu_destino'] ."</td>";
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