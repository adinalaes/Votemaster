<?php
    $just_started = 0;
    if(session_status() != 2){
        session_start();
        $just_started = 1;
    }

    if(!isset($_SESSION["logged_hall"])){
        $response = array(
            "status" => false,
            "code" => 100,
            "message" => "Not logged in."
        );
        echo json_encode($response);
        exit();
    }

    if($just_started == 1){
        $response = array(
            "status" => true,
            "code" => 0,
            "message" => "Logged in"
        );
        echo json_encode($response);
        exit();
    }
    
    

?>