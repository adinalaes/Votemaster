<?php

    include('connect.php');


    $email = $_POST["email"];
    $password = $_POST["password"];
    $city_id = $_POST["city_id"];

    if(empty($email) || empty($password) || empty($city_id)){
        $response = array(
            "status" => false,
            "message" => "Missing data."
        );
        echo json_encode($response);
        exit();
    }

    $SQL_test = "SELECT 1 FROM hall_accounts WHERE email = '$email' OR city_id=$city_id ";
    $result = $conn->query($SQL_test);

    if($result->num_rows > 0){
        $response = array(
            "status" => false,
            "message" => "Email already in use or city already in system."
        );
        echo json_encode($response);
        exit();
    }


    $SQL_register = "INSERT INTO hall_accounts (email, password, city_id) VALUES ('$email', '$password', $city_id)";
    $conn->query($SQL_register);

    $response = array(
        "status" => true,
        "message" => "Succes."
    );
    echo json_encode($response);

?>