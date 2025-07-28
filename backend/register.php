<?php

    include('connect.php');

    function verify_cnp($cnp){
        if(strlen($cnp) == 13){
            return 1;
        }
        return 0;
    }

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $cnp = $_POST["cnp"];
    $city = $_POST["city"];

    $SQL_test_email = "SELECT 1 FROM client_accounts WHERE email = '$email' ";
    $result = $conn->query($SQL_test_email);

    if(empty($first_name) || empty($last_name) || empty($email) || empty($pass) || empty($cnp) || empty($city)){
        $response = array(
            "status" => false,
            "message" => "Missing data."
        );
        echo json_encode($response);
        exit();
    }

    if($result->num_rows > 0){
        $response = array(
            "status" => false,
            "message" => "Email already in use."
        );
        echo json_encode($response);
        exit();
    }

    if(!verify_cnp($cnp)){
        $response = array(
            "status" => false,
            "message" => "Invalid CNP."
        );
        echo json_encode($response);
        exit();
    }

    $SQL_register = "INSERT INTO client_accounts (first_name, last_name, email, password, CNP, ID_oras) VALUES ('$first_name', '$last_name', '$email', '$pass', '$cnp', $city)";
    $conn->query($SQL_register);

    $response = array(
        "status" => true,
        "message" => "Succes."
    );
    echo json_encode($response);

?>