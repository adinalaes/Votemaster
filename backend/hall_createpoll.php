<?php

session_start();
include('connect.php');
include('islogged_hall.php');

$data = $_POST['data'];
$poll = json_decode($data);



