<?php
    require 'checkSource.php';
    //$ip = "10.4.0.15";
    $ip = $_SERVER['REMOTE_ADDR'];
    $from = checksource($ip);
    echo $from;
    echo $ip;
    echo gettype($ip);

?>