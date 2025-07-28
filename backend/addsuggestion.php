<?php

session_start();
include('connect.php');
include('islogged.php');

$poll_id = $_POST['poll_id'];
$suggestion = $_POST['suggestion_text'];
$client_id = $_SESSION['id'];

if(empty($poll_id) || empty($suggestion)){
    exit();
}

$SQL_insert = "INSERT INTO client_suggestions (client_id, poll_id, suggestion_text) VALUES ($client_id, $poll_id, '$suggestion')";
$result = $conn->query($SQL_insert);

$response = array(
    "status" => true,
    "code" => 0,
    "message" => "Sent"
);
echo json_encode($response);

?>