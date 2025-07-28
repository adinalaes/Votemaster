<?php 

    session_start();
    include('connect.php');
    include('islogged_hall.php');

    $SQL_polls = "SELECT * FROM polls WHERE city_id = " . $_SESSION['city'];
    $result = $conn->query($SQL_polls);

    if($result->num_rows == 0){
        $response = array(
            "status" => false,
            "code" => 404,
            "message" => "This city has no active polls."
        );
        echo json_encode($response);
        exit();
    }

    $response = array(
        "status" => true,
        "code" => 0,
        "data" => array("polls" => array(), "city")
    );

    while($row = mysqli_fetch_array($result)){

        $poll_buffer = array(
            "poll_id" => $row["poll_id"],
            "poll_name" => $row["poll_name"],
            "poll_picture" => $row["poll_picture"],
            "active" => $row["active"]
        );

        array_push($response["data"]["polls"], $poll_buffer);
    }

    $SQL_city = "SELECT * FROM cities WHERE city_id = " . $_SESSION['city'];
    $result = $conn->query($SQL_city);

    if($result->num_rows != 0){
        $row = mysqli_fetch_array($result);
        $response["data"]["city"] = $row["city_name"];
    }



    echo json_encode($response);

?>