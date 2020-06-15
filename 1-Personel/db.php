<?php  

$host="localhost";
$user="root";
$password="";
$database="Personel";


$conn=mysqli_connect("Localhost", "root", "", "Personel");
$conn->set_charset('utf8');
if(!$conn){
  echo "Error: " . mysqli_connect_error();
}


?>