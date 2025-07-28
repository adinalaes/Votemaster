<?php 

    session_start();
    include('connect.php');

    if (empty($_POST["email"]) || empty($_POST["pass"])){
        $response = array(
            "status" => false,
            "code" => "1",
            "message" => "Missing data."
        );
        echo json_encode($response);
        exit();
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $SQL_verify = "SELECT * FROM client_accounts WHERE email = '$email' AND password = '$pass' ";
    $result = $conn->query($SQL_verify);

    if($result->num_rows == 0){
        $response = array(
            "status" => false,
            "code" => "2",
            "message" => "Incorrect email or password."
        );
        echo json_encode($response);
        exit();
    }

    $response = array(
        "status" => true,
        "code" => "0",
        "message" => "Succes."
    );
    echo json_encode($response);

    $details = mysqli_fetch_array($result);
    
    session_destroy();
    session_start();
    $_SESSION["logged"] = 1;
    $_SESSION["name"] =  $details["first_name"];
    $_SESSION["id"] = $details["ID_client"];
    $_SESSION["city"] = $details["ID_oras"];
?>