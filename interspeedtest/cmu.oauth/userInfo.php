<?php
session_start();
$accessToken = $_SESSION['accessToken'];
echo $accessToken;

require('userinfo.class.php');

$userinfo = new UserInfo();
$user = $userinfo->getUserInfo($accessToken);
echo "<pre>";
var_dump($user);
echo "</pre>";

echo "<br>";
echo "<a href=\"index.php\">Home</a>";
?>
