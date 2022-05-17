<?php
session_start();



function checkap($ip){
    $servername = 'db';
    $username = 'user';
    $password = 'test';
    $dbname = 'speedtest';
$userid = $_SESSION['sUserid'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT apname FROM user_ap WHERE user='$userid' AND ip='$ip' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  $data;
  while($row = $result->fetch_assoc()) {
    $data[] =  $row["apname"];
    $data[] =  $row["mac"];
  }
  return $data;
} else {
  $nodata;
  $nodata[] = "no data";
  $nodata[] = "no data";
  return $nodata;
}
$conn->close();
}

?>
