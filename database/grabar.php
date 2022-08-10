<link rel="stylesheet" href=".bootstrap.min.css">
<?php
    //Conectar a la base
    include 'conexion.php';

    //Datos a grabar
    $usr=$_POST["usr"];
    $pass=$_POST["pass"];
    $pro=$_POST["provincia"];
    //$can=$_POST["canton0"];
    //$can=$_POST["canton1"];
    //echo "<h1>{$can}</h1>";
    //Concatenar canton
    if($pro=='El Oro'){
        $a=0;
        //echo "<h1>{$pro}</h1>";
        //echo "<h1>Pasa0</h1>";
        $can=$_POST["canton".$a];
        //echo "<h1>{$can}</h1>";
        //echo "<h1>ya0</h1>";
    };
    if($pro=='Esmeraldas'){
        $a=1;
        //echo "<h1>{$pro}</h1>";
        //echo "<h1>Pasa1</h1>";
        $can=$_POST["canton".$a];
        //echo "<h1>{$can}</h1>";
        //echo "<h1>ya1</h1>";
    };
    if($pro=='Guayas'){
        $a=2;
        $can=$_POST["canton".$a];
    };
    if($pro=='Los Ríos'){
        $a=3;
        $can=$_POST["canton".$a];
    };
    if($pro=='Manabí'){
        $a=4;
        $can=$_POST["canton".$a];
    };
    if($pro=='Santa Elena'){
        $a=5;
        $can=$_POST["canton".$a];
    };
    if($pro=='Santo Domingo'){
        $a=6;
        $can=$_POST["canton".$a];
    };
    if($pro=='Azuay'){
        $a=7;
        $can=$_POST["canton".$a];
    };
    if($pro=='Bolivar'){
        $a=8;
        $can=$_POST["canton".$a];
    };
    if($pro=='Cañar'){
        $a=9;
        $can=$_POST["canton".$a];
    };
    if($pro=='Carchi'){
        $a=10;
        $can=$_POST["canton".$a];
    };
    if($pro=='Chimborazo'){
        $a=11;
        $can=$_POST["canton".$a];
    };
    if($pro=='Cotopaxi'){
        $a=12;
        $can=$_POST["canton".$a];
    };
    if($pro=='Imbabura'){
        $a=13;
        $can=$_POST["canton".$a];
    };
    if($pro=='Loja'){
        $a=14;
        $can=$_POST["canton".$a];
    };
    if($pro=='Pichincha'){
        $a=15;
        $can=$_POST["canton".$a];
    };
    if($pro=='Tungurahua'){
        $a=16;
        $can=$_POST["canton".$a];
    };
    if($pro=='Morona Santiago'){
        $a=17;
        $can=$_POST["canton".$a];
    };
    if($pro=='Napo'){
        $a=18;
        $can=$_POST["canton".$a];
    };
    if($pro=='Orellana'){
        $a=19;
        $can=$_POST["canton".$a];
    };
    if($pro=='Pastaza'){
        $a=20;
        $can=$_POST["canton".$a];
    };
    if($pro=='Sucumbios'){
        $a=21;
        $can=$_POST["canton".$a];
    };
    if($pro=='Zamora'){
        $a=22;
        $can=$_POST["canton".$a];
    };
    if($pro=='Galápagos'){
        $a=23;
        $can=$_POST["canton".$a];
    };

    $email=$_POST["email"];
    $edad=$_POST["age"];

    //Insertar en la base de datos
    $cmd="INSERT INTO `registro`(`user`, `edad`, `password`, `provincia`, `canton`, `email`, `latitud`, `longitud`) VALUES ('{$usr}','{$edad}','{$pass}','{$pro}','{$can}','{$email}','','')";
    if(!mysqli_query($conn,$cmd))
        echo "<a style='font-size:25px;'>Usuario o Correo ya registrado, click </a><a style='font-size:25px;' href='indexnewusr.html'>aqui</a><a style='font-size:25px;'> para volver.</a>";
    else
        echo "<a style='font-size:25px;'>Si los datos son correctos se le enviara un correo para activar la cuenta, click </a><a style='font-size:25px;' href='index.html'>aqui</a><a style='font-size:25px;'> para volver a inicio.</a>";
?>