<?php
    session_start();
    $name = $_POST['name'];
    $dd = $name;
    $re = str_replace(" ","",$dd);
    $re = str_replace("-","",$re);
    $re = str_replace(":","",$re);
    $re = substr($re, 0, strpos($re, "."));
    $re = str_replace("T","",$re);
    $re = str_replace("Z","",$re);

    $d = str_replace("T"," ",$name);
    $d = substr($d, 0, strpos($d, "."));
    $message = $re;
    $_SESSION['testcode'] = $message;
    $_SESSION['testdate'] = $d;
    $response = array();
    $response["success"] = true;
    $response["message"] = $d;
    echo json_encode($response);
?>