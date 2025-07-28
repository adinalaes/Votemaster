<?php

$servername = "89.44.120.51";
$database = "ceapac_votemaster_FIS";
$username = "ceapac_FIS";
$password = "ParolaFIS123!";

try{
    $conn = mysqli_connect($servername, $username, $password, $database);
} catch (Exception $e){
    echo "Error connecting to the VOTEMASTER database.<br>";
    echo $e->getMessage();
    exit();
}


?>