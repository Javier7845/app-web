<link rel="stylesheet" href=".bootstrap.min.css">
<?php
    //Conectar a la base de datos
    include 'conexion.php';

    $usr=$_POST["usr"];
    $pass=$_POST["pass"];

    $ans=$conn->query("SELECT COUNT(1) FROM `registro` WHERE password = '{$pass}' AND user = '{$usr}'");

    $row1 = $ans->fetch_array();
    
    //Entrar si hay 1 caso contrario vuelve a la pagina
    if($row1['COUNT(1)']==1)
        //header("refresh:0;url='/pf/index.php'");
        echo "<meta http-equiv='Refresh' content='0; url=./index.php'>";
    else{
        echo "<a style='font-size:25px;'>Usuario no encontrado o contraseña incorrecta, volviendo...</a>";
        //header("refresh:2;url='/pf/index.html'");
        echo "<meta http-equiv='Refresh' content='2; url=./index.html'>";
    }
?>