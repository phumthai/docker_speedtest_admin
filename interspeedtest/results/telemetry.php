<?php

session_start();
if(!isset($_SESSION['sUserid'])){
    exit(0);
}
$userid = $_SESSION['sUserid'];

require 'telemetry_settings.php';
require_once 'telemetry_db.php';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
    $ip = $_SERVER['HTTP_X_REAL_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ip = preg_replace('/,.*/', '', $ip); # hosts are comma-separated, client is first
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$ispinfo = $_POST['ispinfo'];
$extra = $_POST['extra'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$lang = '';
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
}
$dl = $_POST['dl'];
$ul = $_POST['ul'];
$ping = $_POST['ping'];
$jitter = $_POST['jitter'];
$log = $_POST['log'];

if (isset($redact_ip_addresses) && true === $redact_ip_addresses) {
    $ip = '0.0.0.0';
    $ipv4_regex = '/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/';
    $ipv6_regex = '/(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))/';
    $hostname_regex = '/"hostname":"([^\\\\"]|\\\\")*"/';
    $ispinfo = preg_replace($ipv4_regex, '0.0.0.0', $ispinfo);
    $ispinfo = preg_replace($ipv6_regex, '0.0.0.0', $ispinfo);
    $ispinfo = preg_replace($hostname_regex, '"hostname":"REDACTED"', $ispinfo);
    $log = preg_replace($ipv4_regex, '0.0.0.0', $log);
    $log = preg_replace($ipv6_regex, '0.0.0.0', $log);
    $log = preg_replace($hostname_regex, '"hostname":"REDACTED"', $log);
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, s-maxage=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

if($ispinfo==null&&$extra==null&&$dl==null&&$ul==null&&$ping==null&&$jitter==null&&$log==null){
    exit(0);
}

require 'checkSource.php';
$subnet = checksource($ip);

// require 'checkAP2.php';
// $getap = checkap2($ip);
// $apname = $getap[0];
// $mac = $getap[1];
// $ssid = $getap[2];
// $testcode = $_SESSION['testcode'];
// $timestamp = $_SESSION['testdate'];

$apname = $_SESSION['apname'];
$mac = $_SESSION['mac'];
$ssid = $_SESSION['ssid'];
$testcode = $_SESSION['testcode'];
$timestamp = $_SESSION['testdate'];
$utilize24 = $_SESSION['utilize24'];
$utilize5 = $_SESSION['utilize5'];
$clientnum24 = $_SESSION['clientnum24'];
$clientnum5 = $_SESSION['clientnum5'];

$apname = "a";
$mac = "a";
$ssid = "a";
// $testcode = $_SESSION['testcode'];
// $timestamp = $_SESSION['testdate'];
// $utilize24 = "a";
// $utilize5 = "a";
// $clientnum24 = "a";
// $clientnum5 = "a";

$id = insertSpeedtestUser($ip, $ispinfo, $extra, $ua, $lang, $dl, $ul, $ping, $jitter, $log, $userid, $subnet, $apname, $mac, $testcode, $ssid, $timestamp,$utilize24,$utilize5,$clientnum24,$clientnum5);
if (false === $id) {
    exit(1);
}

echo 'id '.$id;
