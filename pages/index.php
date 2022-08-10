<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Alert Car</title>

    <style>
        .bbv {border: solid 1px;color: white;}
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src=".bootstrap.bundle.min.js"></script>
    <script src=".jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href=".bootstrap-select.css">
    <script src=".bootstrap-select.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        //Posicion
        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }
        }
        function showPosition(position){
            la=position.coords.latitude;
            lo=position.coords.longitude;
            x=document.getElementById("la1");
            x.style="color:black";
            x.value=la;
            document.cookie="x="+la;
            y=document.getElementById("lo1");
            y.style="color:black";
            y.value=lo;
            document.cookie="y="+lo;
        }
    </script>
</head>
<body style="background-color: black;" onload="getLocation()">
    <div class="container">
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col text-center">
                <a style="font-size: 110px;color:white;">Bienvenido a Alert Car</a>
            </div>
        </div>

        <br/>
        <br/>
        <br/>

        <div class="row">
            <div class="col text-end">
                <form action="index.html">
                    <input type="submit" value="Log out" style="background-color:black;color:red;padding:0px;border: 0px;margin:0px;">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col bv text-center">
                <a style="font-size: 70px;color: white;">¿Viste un operativo?</a><br>
                <form action="index.php" method="post">
                    <input style="font-weight: normal;width:235px;" type="text" name="la" id="la1">
                    <input style="font-weight: normal;width:235px;" type="text" name="lo" id="lo1"><br/>
                    <input type="submit" value="Click aqui para reportar" style="background-color:black;color:red;padding:0px;border: 0px;margin:0px;font-size: 25px;color:yellow;">
                </form>
            </div>
        </div>

    </div>
    <?php
        //Actualiza mi ubicacion en la base de datos Users
        $conn=mysqli_connect("db","root","2022","users");
        if(!$conn){
            echo "no se pudo conectar...";
            exit;
        }
        $la=$_COOKIE["x"];
        $lo=$_COOKIE["y"];
        echo "<div class='container'><div class='row'><div class='col bv text-center'><a style='font-size: 20px;' href='https://www.google.com/maps/dir/{$la},{$lo}'>Ver mi ubicacion</a></div></div></div>";
        $cmd="UPDATE `registro` SET `latitud`='{$la}', `longitud`='{$lo}' WHERE user='javerfriv'";
        if(!mysqli_query($conn,$cmd))
            echo "<a style='font-size:25px;'></a>";
        else
            //header("refresh:120; url=/pf/index.php");//5min
            echo "<meta http-equiv='Refresh' content='120; url=./index.php'>";//5min

        //Conectar a la base de Operativos y guarda la ubicacion de un operativo
        $conn=mysqli_connect("db","root","2022","users");
        if(!$conn){
            echo "no se pudo conectar...";
            exit;
        }
        //Datos a grabar
        $la='';
        $lo='';
        if(isset($_POST["la"])){
            $la=$_POST["la"];
        }
        if(isset($_POST["lo"])){
            $lo=$_POST["lo"];
        }
        /*
        $la=$_POST["la"];
        $lo=$_POST["lo"];
        */
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $cmd="INSERT INTO `coordenadas`(`latitud`, `longitud`) VALUES ('{$la}','{$lo}')";
            if(!mysqli_query($conn,$cmd))
                echo "<a style='font-size:25px;'></a>";
            else
                //header("Location: /pf/index.php");
                echo "<meta http-equiv='Refresh' content='0; url=./index.php'>";
        }
        //Saber cuantos operativos
        $anss=$conn->query("SELECT COUNT(*) FROM coordenadas");
        $row = $anss->fetch_array();
        echo "<div class='container'><div class='row'><div class='col bv text-center'><br/><br/><br/><a style='font-size: 30px;color:white;'>Actualmente hay {$row['COUNT(*)']} operativos a nivel nacional</a><br/><br/><br/></div></div></div>";
        

        //Conecta con la base de datos operativos y me dice si hay o no un operativo a 1km de distancia
        $ans=$conn->query("SELECT * FROM `coordenadas` ORDER BY id");
        echo "<div class='container'><div class='row'><div class='col bv text-center'><a style='font-size: 50px;color: white;'>Operativos a menos de 1 km de tu ubicación</a></div></div></div>";
        while($row=$ans->fetch_array()){
            //Base de datos user latitud longitud
            $lat2=$_COOKIE["x"];
            $lon2=$_COOKIE["y"];

            //Base de datos operativo
            $lat1=$row["latitud"];
            $lon1=$row["longitud"];
            //echo "{$lat1} {$lon1}";

            //Calcular la distancia
            $R=6617433;
            $t1=$lat1*M_PI/180;
            $t2=$lat2*M_PI/180;
            $dt=($lat2-$lat1)*M_PI/180;
            $da=($lon2-$lon1)*M_PI/180;
            $a=sin($dt/2)*sin($dt/2)+cos($t1)*cos($t2)*sin($da/2)*sin($da/2);
            $c= 2*atan2(sqrt($a),sqrt(1-$a));
            $result=round($R*$c);
            
            //Si la distancia es > 1km para el programa y muestra que hay un operativo
            if(round($R*$c)<1000){
                echo "<div class='container'><div class='row'><div class='col bv text-center'><a style='font-size: 40px;color: red;'>Hay un operativo a {$result} metros de tu ubicación.</a><br/><a style='font-size: 20px;' href='https://www.google.com/maps/dir/{$lat2},{$lon2}/{$lat1},{$lon1}'>Ver mapa</a></div></div></div>";
                //exit;
            }
            else{
                //echo "<div class='container'><div class='row'><div class='col bv text-center'><a style='font-size: 40px;color: green;'>No hay operativos cerca de tu ubicacion.</a><br/><a style='font-size: 20px;' href='https://www.google.com/maps/dir/{$lat2},{$lon2}/{$lat1},{$lon1}'>Ver mapa</a></div></div></div>";
            }
        }
    ?>
</body>
</html>