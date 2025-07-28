<?php 

    session_start();
    include('connect.php');
    include('islogged.php');

    $SQL_client = "SELECT * FROM client_accounts LEFT JOIN cities ON client_accounts.ID_oras = cities.city_id WHERE client_accounts.ID_client = " . $_SESSION['id'];
    $result = $conn->query($SQL_client);

    if($result->num_rows == 0){
        $response = array(
            "status" => false,
            "code" => 404,
            "message" => "This client does not exist"
        );
        echo json_encode($response);
        exit();
    }

    $row = mysqli_fetch_array($result);

    $response = array(
        "status" => true,
        "code" => 0,
        "data" => array("client_full_name" => $row["last_name"] . " " . $row["first_name"], "city" => $row['city_name'], "email" => $row['email'], "votes" => array())
    );

    $SQL_votes = "SELECT * FROM votes LEFT JOIN poll_options ON votes.option_id = poll_options.option_id LEFT JOIN polls ON poll_options.poll_id = polls.poll_id WHERE votes.client_id =" . $_SESSION['id'];
    $result = $conn->query($SQL_votes);

    if($result->num_rows == 0){
        echo json_encode($response);
        exit();
    }

    while($row = mysqli_fetch_array($result)){

        $votes_buffer = array(
            "poll_name" => $row["poll_name"],
            "option_name" => $row["option_name"]
        );

        array_push($response["data"]["votes"], $votes_buffer);
    }


    echo json_encode($response);

?>