<?php 
session_start();
date_default_timezone_set("Asia/Kolkata");
$con = mysqli_connect("localhost","root","","miniquora");

if($con==false){
    die('Connection failed');
}
?>