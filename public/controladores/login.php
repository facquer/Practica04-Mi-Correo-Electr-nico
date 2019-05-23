<?php

    session_start();

    include '../../config/conexion.php';

    $usuario = isset($_POST["user"]) ? trim($_POST["user"]) : null;

    $contrasena = isset($_POST["password"]) ? trim($_POST["password"]) : null;

    $sql = "SELECT count(*) as login  
            FROM usuarios
            WHERE usu_correo = '$usuario' and 
                  usu_password = MD5('$contrasena') and
                  usu_eliminado = 'N'";


    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if ($row["login"] == 1) {
        
        $sql_1 ="SELECT usu_rol_id as rol,
                        usu_codigo as id
               FROM usuarios
               WHERE usu_correo = '$usuario' and
                     usu_password = MD5('$contrasena')";
        
        $result_1 = $conn->query($sql_1);
        $row_1 = $result_1 ->fetch_assoc();
        
        if($row_1["rol"] == 1){
            $_SESSION['isLogged'] = TRUE;
            header("Location: ../../vista/admin/vista/index.php?codigo=".$row_1["id"]);    
        }else{
            $_SESSION['isLogged'] = TRUE;
            header("Location: ../../vista/user/vista/index.php?codigo=".$row_1["id"]);
        }
        
    }else{
        header("Location: ../vista/login.html");
    }

    $conn->close();
    
?>