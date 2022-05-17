<?php
  if(!isset($_SESSION)){
    session_start();
  }
  function checkap2($ip){
    $servername = '';
    $username = '';
    $password = '';
    $dbname = '';
    $userid = $_SESSION['sUserid'];
    
    $date = date('Ymd');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM  WHERE ip='$ip' ORDER BY `time` DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $data;
      while($row = $result->fetch_assoc()) {
        if($userid)
        $data[] =  $row["apName"];
        $data[] =  $row["mac"];
      }
      return $data;
    } else {
      return "No AP data";
    }
    $conn->close();
  }

?>