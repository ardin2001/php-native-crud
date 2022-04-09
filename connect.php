<?php
$localhost = "localhost";
$user      = "root";
$password  = "";
$database  = "sakila";

$connection = mysqli_connect($localhost,$user,$password,$database);
// if(!$connection){
//     echo("Database tidak terhubung");
// }else{
//     echo("Database terhubung");
// }

?>