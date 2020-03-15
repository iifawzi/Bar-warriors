<?php
$host="localhost";
$username="root";
$password="";
$database="loginsys";
$conn=mysqli_connect($host,$username,$password,$database);
if (!$conn) {
	die('Connection error'.mysqli_connect_error());
}
  ?>