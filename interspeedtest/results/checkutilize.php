<?php
  if(!isset($_SESSION)){
    session_start();
  }
  function checkutilize($ip){
    require 'checkAP2.php';
    $getap = checkap2($ip);
    $apname = $getap[0];

    $servername = '';
    $username = '';
    $password = '';
    $dbname = '';
    
    $date = date('Ymd');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM snmp WHERE apname='$apname' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $data;
      while($row = $result->fetch_assoc()) {
        if($userid)
        $data[] =  $row["utilize24"];
        $data[] =  $row["utilize5"];
        $data[] =  $row["clientnum24"];
        $data[] =  $row["clientnum5"];
      }
      return $data;
    } else {
      return "No utilize data";
    }
    $conn->close();
  }
?>