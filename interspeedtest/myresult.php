<?php
session_start();
require 'results/telemetry_settings.php';
if(!isset($_SESSION['sUserid'])){
    header( "location: http://localhost/interspeedtest/index.php" );
	exit(0);
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
    <meta charset="UTF-8" />
    <title>CMUnet Test result</title>
    <link rel="stylesheet" href="index.css" />
</head>
<style>
    html,body{
        margin:0;
        padding:0;
        border:none;
        width:100%; min-height:100%;
    }
    html{
        background-color: #bcbcbc;
        font-family: "Segoe UI","Roboto",sans-serif;
    }
    body{
        background-color:#FFFFFF;
        box-sizing:border-box;
        width:100%;
        max-width:70em;
        margin:4em auto;
        box-shadow:0 1em 6em #00000080;
        padding:1em 1em 4em 1em;
        border-radius:0.4em;
    }
    h1,h2,h3,h4,h5,h6{
        font-weight:300;
        margin-bottom: 0.1em;
    }
    h1{
        text-align:center;
    }
    table{
        margin:2em 0;
        width:100%;
    }
    table, tr, th, td {
        border-collapse: collapse;
        border: 1px solid #AAAAAA;
        text-align:center;
        height: 40px;
    }
    th {
        width: 6em;
        background-color: #e6e3e3;
    }
    td {
        word-break: break-all;
    }
</style>
<body>
    <br>
    <h1>Test History</h1>
<?php
    $userid = $_SESSION['sUserid'];
    echo "<h4>$userid</h4>";
?>
<div>
    <table>
        <thead>
            <tr>
                <th>Test Code</th>
                <th>Timp stamp</th>
                <th>IP</th>
                <th>AP Name</th>
                <th>Download</th>
                <th>Upload</th>
                <th>Ping</th>
                <th>Jitter</th>
            </tr>
        </thead>
        <tbody>

        <?php
        // Create connection
        $conn = new mysqli($MySql_hostname, $MySql_username, $MySql_password, $MySql_databasename, $MySql_port = '3306');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT testcode, ip, timestamp, dl, ul, ping, jitter, apname FROM speedtest_users Where userid = '$userid'";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["testcode"]. "</td><td>" . $row["timestamp"]. "</td><td>" . $row["ip"]. "</td><td>" . $row["apname"]. "</td><td>" . $row["dl"]. "</td><td>" . $row["ul"]. "</td><td>" . $row["ping"]. "</td><td>" . $row["jitter"]. "</td></tr>"; 
        }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
        </tbody>
    </table>
</div>





</body>
</html>