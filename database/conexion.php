<?php
    //Conectar a la base
    $conn=mysqli_connect("db","root","2022","users");
    if(!$conn){
        echo "no se pudo conectar...";
        exit;
    }
?>
