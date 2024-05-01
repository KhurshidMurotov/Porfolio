<?php 

$servername="localhost";
$username="root";
$password="";
$dbname="login1";
$con=mysqli_connect($servername,$username,$password,$dbname);

if($con->connect_error)
{
    die("connection failed".$con->connect_error);
}
echo"connection successfull";
?>