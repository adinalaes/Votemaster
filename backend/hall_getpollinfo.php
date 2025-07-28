<?php 

    session_start();
    include('connect.php');
    include('islogged_hall.php');

    if(empty($_POST["poll_id"])){
        $response = array(
            "status" => false,
            "code" => 10,
            "message" => "Missing data."
        );
        echo json_encode($response);
        exit();
    }

    $SQL_polls = "SELECT * FROM polls WHERE poll_id = " . $_POST["poll_id"] . " AND city_id=" . $_SESSION["city"];
    $result = $conn->query($SQL_polls);

    if($result->num_rows == 0){
        $response = array(
            "status" => false,
            "code" => 404,
            "message" => "This poll does not exist."
        );
        echo json_encode($response);
        exit();
    }

    $row = mysqli_fetch_array($result);

    $response = array(
        "status" => true,
        "code" => 0,
        "data" => array("poll_info" => array('city_id'=>$row['city_id'], 'poll_name'=>$row['poll_name'], 'poll_description'=>$row['poll_description'], 'active'=>$row["active"]), "poll_options" => array())
    );

    $SQL_options = "SELECT * FROM poll_options WHERE poll_id = " . $_POST['poll_id'];
    $result = $conn->query($SQL_options);

    while($row = mysqli_fetch_array($result)){

        $SQL_count = "SELECT COUNT(vote_id) AS total FROM votes WHERE option_id = ". $row['option_id'];
        $result2 = $conn->query($SQL_count);

        $row2 = mysqli_fetch_array($result2);

        $option_buffer = array(
            "option_id" => $row["option_id"],
            "option_name" => $row["option_name"],
            "option_description" => $row["option_description"],
            "option_image" => $row["option_image"],
            "option_votes" => $row2["total"]
        );

        array_push($response["data"]["poll_options"], $option_buffer);
    }

    $SQL_voted = "SELECT votes.option_id FROM votes INNER JOIN poll_options ON votes.option_id=poll_options.option_id WHERE votes.client_id=" . $_SESSION["id"] ." AND poll_options.poll_id=" . $_POST["poll_id"];
    $result = $conn->query($SQL_voted);

    if($result->num_rows == 0){
        $response["data"]["poll_vote"] = 0;
    } else {
        $row = mysqli_fetch_array($result);
        $response["data"]["poll_vote"] = $row["option_id"];
    }

    echo json_encode($response);

?>