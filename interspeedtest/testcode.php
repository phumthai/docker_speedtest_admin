<?php
    session_start();
    $name = $_POST['name'];
    $dd = $name;
    $re = str_replace(" ","",$dd);
    $re = str_replace("-","",$re);
    $re = str_replace(":","",$re);
    $re = str_replace(".","",$re);
    $re = str_replace("T","",$re);
    $re = str_replace("Z","",$re);

    $d = str_replace("T"," ",$name);
    $d = str_replace("Z","",$d);
    $message = $re;
    $_SESSION['testcode'] = $message;
    $_SESSION['testdate'] = $name;
    $response = array();
    $response["success"] = true;
    $response["message"] = $d;
    echo json_encode($response);
?>