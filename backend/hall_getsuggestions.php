<?php 

    session_start();
    include('connect.php');
    include('islogged_hall.php');

    $SQL_polls = "SELECT * FROM client_suggestions WHERE poll_id = " . $_POST['poll_id'];
    $result = $conn->query($SQL_polls);

    if($result->num_rows == 0){
        $response = array(
            "status" => false,
            "code" => 404,
            "message" => "No suggestions."
        );
        echo json_encode($response);
        exit();
    }

    $response = array(
        "status" => true,
        "code" => 0,
        "data" => array()
    );

    while($row = mysqli_fetch_array($result)){
        array_push($response["data"], $row["suggestion_text"]);
    }
    
    echo json_encode($response);


?>