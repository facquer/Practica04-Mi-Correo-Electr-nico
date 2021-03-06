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
    <title>Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/stylesGeneral.css">
    <link rel="stylesheet" href="css/stylesLogin.css">
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
        if($rowc["usu_rol_id"] == 2){
           header("Location: ../../../public/vista/blanco.html"); 
        }
  ?>
  <?php
     $codigo = $_GET['id'];
   ?>
   <header class="header">
       <div class="header header-wrap-one">
           <div class="container cf">
           <h1 class="logo"><a href="#">CORREO</a></h1>
           <div class="menu-toggle">Menu</div>
           <div class="navigation">
              <ul>
              <?php
                    echo "<li>"."<a href=index.php?codigo=".$codigo.">Mensajes</a></li>";
                  ?>
                  <li><a href="#">Usuarios</a></li>
                  <?php
                    echo "<li>"."<a href=perfil.php?id=".$codigo.">Mi Cuenta</a></li>";
                  ?>
                  
                  <li><a href="../controladores/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>
            </div>

   </header>
   <main class="align">
    <section class="mail">
    <h1>Usuarios</h1><br>
            <form action="" class="busqueda">
                <input type="text"  id="remite" name="remitente" value="<?php echo $codigo?>" hidden="hidden">
                <input type="text" name="correo" placeholder="buscar por correo" id="correo" value="" onkeyup="buscarPorUsuario()">
            </form>
        <br>
        <div id="informacion">
            <table id="estilo">
            <tr id="cabecera">
                <thead>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Correo</th>
                    <th>Datos</th>
                    <th>Cambiar</th>
                    <th>Eliminar</th>
                </thead>
            </tr>
            <?php
                $codigo = $_GET['id'];
                $sql ="SELECT *
                FROM usuarios
                WHERE usu_eliminado = 'N'
                ORDER BY usu_codigo";
                $result = $conn->query($sql);
                
                if($result->num_rows > 0){
                         while($row = $result->fetch_assoc()){
                             echo "<tr>";
                                echo " <td>" . $row['usu_nombres'] . "</td>";
                                echo " <td>" . $row['usu_apellidos'] ."</td>";
                                echo " <td>" . $row['usu_cedula'] ."</td>";
                                echo " <td>" . $row['usu_fecha_nac'] ."</td>";
                                echo " <td>" . $row['usu_correo'] . "</td>";
                                echo " <td>" . "<a href=perfil_modifica.php?idU=".$row['usu_codigo']."&id=".$codigo.">Modificar Datos"."</a>"."</td>";
                                echo " <td>" . "<a href=contrasena.php?id=".$row['usu_codigo']."&id=".$codigo.">Cambiar Contraseña"."</a>"."</td>";
                                echo " <td>" . "<a href=../controladores/eliminar_usuario.php?idU=".$row['usu_codigo']."&id=".$codigo.">Eliminar"."</a>"."</td>";
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