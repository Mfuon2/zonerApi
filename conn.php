<?php
$user = "fm";
$pass = "Systech321$";
$host= "192.168.10.39";
$dbname="kuzadoml_zoner";
$conn = mysqli_connect($host,$user,$pass,$dbname);
if(!$conn){
	echo "no connection to database";
}
?>