<?php
    
    include "connection.php";
    if(isset($_GET['city'])){
    $city=$_GET["city"];
    $temp=$_GET["temp"];
    $weatherType=$_GET["weather"];
    }


    function storeInLocalStorage($data) {
        echo "<script>";
        foreach ($data as $key => $value){
            echo "localStorage.setItem('$key','$value');";
        }
        echo "</script>";
    }

    $data = array (
        "weatherType" => $weatherType,
        "temperature" => $temp
    );
    storeInLocalStorage($data);





    $fetch_query = "SELECT * FROM weather WHERE city = '{$city}' AND weather_when >= DATE_SUB(NOW(), interval 100 SECOND)";
    $result = mysqli_query($con, $fetch_query);


    if($result->num_rows == 0){
        $insert = "INSERT INTO weather(`city`, `temp`, `weatherType`) VALUES('{$city}','{$temp}','{$weatherType}')";
        $r = mysqli_query($con, $insert);
        if(!$r) {
            echo "Error: ".mysqli_error($con);
            exit;
        }
    } else {
        $update_query = "UPDATE weather SET temp='{$temp}', weatherType='{$weatherType}' WHERE city='{$city}'";
        $l = mysqli_query($con, $update_query);
        if(!$l) {
            echo "Error: ".mysqli_error($con);
            exit;
        }
    }
    


    function displayWeather($city) {
        include "connection.php";
        $fetch_query = "SELECT * FROM weather WHERE city='{$city}'";
        $res = mysqli_query($con, $fetch_query);
        if(!$res) {
            echo "Error: ".mysqli_error($con);
            exit;
        }
        $row = mysqli_fetch_array($res);
        if(!$row) {
            echo "No data found for city: {$city}";
            exit;
        }
    
        include "index.php";
        echo "<div class='weather'>
                <div id='result'>{$row["city"]}</div>
                <h1 class='temp'>{$row["temp"]}°C</h1>
                <h1 class='city'>{$row["weatherType"]}</h1>
                <h1 class='data'>{$row["weather_when"]}</h1>
            </div>";
    }
    
    displayWeather($_GET["city"]);
    
?>