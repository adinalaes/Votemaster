<?php

    if(session_status() != 2){
        session_start();
    }

    if(!isset($_SESSION["logged"])){
        $response = array(
            "status" => false,
            "code" => 100,
            "message" => "Not logged in."
        );
        echo json_encode($response);
        
        exit();
    }
    
    

?>