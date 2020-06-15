<?php  
$host="localhost";
$user="root";
$password="";
$database="Trigonometri";

$conn=mysqli_connect($host, $user, $password, $database);
if(!$conn){
  echo "Error: " . mysqli_connect_error();
}
 ?>