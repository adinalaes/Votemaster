<?php

    session_start();
    include('connect.php');
    include('islogged_hall.php');

    $poll_id = $_POST["poll_id"];

    if(!empty($poll_id)){
        $SQL_toggle = "UPDATE polls SET active = 1 - active WHERE poll_id=$poll_id AND city_id=" . $_SESSION['city'];
        $conn->query($SQL_toggle);
    }

    echo json_encode(1);

?>