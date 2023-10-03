<?php 
//connect to db

$conn = mysqli_connect('localhost', 'root', '', 'alnil_pizza');

//check connection

if(!$conn){
    echo 'connection error: ' . mysqli_connect_error();
}
?>