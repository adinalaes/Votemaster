<?php
include('connect.php');

$SQL_cities = "SELECT * FROM cities";
$result = $conn->query($SQL_cities);

$ret = array();

while($row = mysqli_fetch_array($result)){
    array_push($ret, $row["city_name"]);
}

echo json_encode($ret);

?>