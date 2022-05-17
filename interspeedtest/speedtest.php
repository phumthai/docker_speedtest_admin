<?php
session_start();
if(!isset($_SESSION['sUserid'])){
    header( "location: http://localhost:8080/index.php" );
	exit(0);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
<meta charset="UTF-8" />
<script type="text/javascript" src="speedtest.js"></script>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet" href="index.css" />
<title>Internet Speedtest</title>
</head>
<body>
<h1>Internet Speedtest</h1>
<div id="testWrapper">
	<div id="startStopBtn" onclick="startStop()"></div><br/>
	<a class="privacy" href="#" onclick="I('privacyPolicy').style.display=''">Privacy</a>
	<div id="test">
		<div class="testGroup">
			<div class="testArea">
				<div class="testName">Download</div>
				<canvas id="dlMeter" class="meter"></canvas>
				<div id="dlText" class="meterText"></div>
				<div class="unit">Mbps</div>
			</div>
			<div class="testArea">
				<div class="testName">Upload</div>
				<canvas id="ulMeter" class="meter"></canvas>
				<div id="ulText" class="meterText"></div>
				<div class="unit">Mbps</div>
			</div>
		</div>
		<div class="testGroup">
			<div class="testArea2">
				<div class="testName">Ping</div>
				<div id="pingText" class="meterText" style="color:#9560aa"></div>
				<div class="unit">ms</div>
			</div>
			<div class="testArea2">
				<div class="testName">Jitter</div>
				<div id="jitText" class="meterText" style="color:#9560aa"></div>
				<div class="unit">ms</div>
			</div>
		</div>
		<div id="ipArea">
			<span id="ip"></span>
			<?php
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
				require __DIR__ . "/results/checkAP2.php";
				$apname = checkAP2($ip);
				echo "<p>$apname</p>";
			?>
		</div>
		<div id="shareArea" style="display:none"></div>
		<?php
			$accessToken = $_SESSION['accessToken'];
			require('userinfo.class.php');
			$userinfo = new UserInfo();
			$user = $userinfo->getUserInfo($accessToken);
			$userid = $user->cmuitaccount;
			echo "<p>$userid</p>";
			$time = date("Y-m-d H:i:s");
			echo "<p>$time</p>";
			echo "<a href=\"myresult.php\" target=\"_blank\">Test history</a>";
		?>
	</div>
</div>
<div id="privacyPolicy" style="display:none">
    <h2>Privacy Policy</h2>
    <h4>What data we collect</h4>
    <p>
        At the end of the test, the following data is collected and stored:
        <ul>
			<li>IP address</li>
            <li>Time of testing</li>
            <li>Test results (download and upload speed, ping and jitter)</li>
        </ul>
    </p>
    <h4>How we use the data</h4>
    <p>
        Data collected through this service is used to:
        <ul>
            <li>To improve the service offered to you (for instance, to detect problems on our side)</li>
        </ul>
        No personal information is disclosed to third parties.
    </p>
    <h4>Your consent</h4>
    <p>
        By starting the test, you consent to the terms of this privacy policy.
    </p>
    <br/><br/>
    <div class="closePrivacyPolicy">
        <a class="privacy" href="#" onclick="I('privacyPolicy').style.display='none'">Close</a>
    </div>
    <br/>
</div>
<script type="text/javascript">setTimeout(function(){initUI()},100);</script>
</body>
</html>
