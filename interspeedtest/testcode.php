<?php
    session_start();
    $name = $_POST['name'];
    $message = $name;
    $_SESSION['testcode'] = $message;
    $response = array();
    $response["success"] = true;
    $response["message"] = $message;
    echo json_encode($response);
?>