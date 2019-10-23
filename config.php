<?php
$link = mysqli_connect("localhost", "root", "", "crudappp");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
//$sql = "CREATE DATABASE crudappp";
//if(mysqli_query($link, $sql)){
//  echo "Database created successfully";
//} else{
//  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
//}
// mysqli_close($link);

//$sql = "CREATE TABLE employees (
//  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//    name VARCHAR(100) NOT NULL,
//    address VARCHAR(255) NOT NULL,
//    salary INT(10) NOT NULL
//       )";

//if(mysqli_query($link, $sql)){
//    echo "Table created successfully.";
//    } else{
//    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
//     }


?>