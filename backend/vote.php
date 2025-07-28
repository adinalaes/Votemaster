<?php
session_start();
include('connect.php');
include('islogged.php');

$option_id = $_POST["option_id"];
$client_id = $_SESSION["id"];
$city_id = $_SESSION["city"];

if(empty($option_id)){
    $response = array(
        "status" => false,
        "code" => 10,
        "message" => "Missing data."
    );
    echo json_encode($response);
    exit();
}


$SQL_check="SELECT polls.poll_id FROM poll_options INNER JOIN polls ON poll_options.poll_id = polls.poll_id WHERE poll_options.option_id = $option_id AND polls.city_id = $city_id AND polls.active = 1";
$result = $conn->query($SQL_check);

if($result->num_rows == 0){
    $response = array(
        "status" => false,
        "code" => 50,
        "message" => "This poll/option does not exist/is closed or you don't have access to it."
    );
    echo json_encode($response);
    exit();
}

$row = mysqli_fetch_array($result);
$current_poll = $row["poll_id"];

$SQL_delete_other="DELETE votes FROM votes LEFT JOIN poll_options ON votes.option_id = poll_options.option_id WHERE poll_options.poll_id=$current_poll AND votes.client_id=$client_id";
$conn->query($SQL_delete_other);

$SQL_vote="INSERT INTO votes (client_id, option_id) VALUES ($client_id, $option_id)";
$conn->query($SQL_vote);

$response = array(
    "status" => true,
    "code" => 0,
    "message" => "Voted."
);
echo json_encode($response);

?>