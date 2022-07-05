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
<?php if($_SESSION['sUserid']=="phumthai.k@cmu.ac.th" ||$_SESSION['sUserid']=="thomhathai.j@cmu.ac.th" ||$_SESSION['sUserid']=="nititorn.p@cmu.ac.th" ||$_SESSION['sUserid']=="chairat.c@cmu.ac.th" ) :?>
	<div style="position: relative;float:right;"><a href="http://localhost:8088" style="color:red;">Admin</a></div>
<?php endif;?>


<h1>Internet Speedtest</h1>
<div id="testWrapper">
	<div id="startStopBtn" onclick="startStop(); showData()"></div><br/>
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
				// require __DIR__ . "/results/checkAPuse.php";
				// $data = checkapuse($ip);
				// echo "<p>$data[1]</p>"; // mac
				// echo "<p>$data[0]</p>"; // ap name
				// echo "<p>$data[2]</p>"; // ssid
			?>
		</div>

		<div id="dataArea" style="display:none">
			<?php
				
				require __DIR__ . "/results/checkAPuse.php";
				$data = checkapuse($ip);
				if($data!='No data'){
					$_SESSION['apname'] = $data[0];
					$_SESSION['mac'] = $data[1];
					$_SESSION['ssid'] = $data[2];
					// echo "<p>$data[1]</p>"; // mac
					echo "<p>$data[0]</p>"; // ap name
					echo "<p>$data[2]</p>"; // ssid
					
				}else{
					$_SESSION['apname'] = 'No data';
					$_SESSION['mac'] = 'No data';
					$_SESSION['ssid'] = 'No data';
				}
				
				require __DIR__ . "/results/checkutilize.php";
				$utilize = checkutilize($ip,$apname);
				if($utilize!='No data'){
					$_SESSION['utilize24'] = $utilize[0];
					$_SESSION['utilize5'] = $utilize[1];
					$_SESSION['clientnum24'] = $utilize[2];
					$_SESSION['clientnum5'] = $utilize[3];
					if($ssid=='@JumboPlus5GHz'){
						echo "<p>Utilize: ".$utilize[1]."</p>";
						echo "<p>Client count: ".$utilize[3]."</p>";
					}else{
						echo "<p>Utilize: ".$utilize[0]."</p>";
						echo "<p>Client count: ".$utilize[2]."</p>";
					}
				}else{
					$_SESSION['utilize24'] = 'No data';
					$_SESSION['utilize5'] ='No data';
					$_SESSION['clientnum24'] ='No data';
					$_SESSION['clientnum5'] ='No data';
				}
			?>
        </div>
		<p id="testcode"></p>
		<div id="shareArea" style="display:none"></div>
		<?php
			// $accessToken = $_SESSION['accessToken'];
			// require('userinfo.class.php');
			// $userinfo = new UserInfo();
			// $user = $userinfo->getUserInfo($accessToken);
			// $userid = $user->cmuitaccount;
			// echo "<p>$userid</p>";
			// date_default_timezone_set("Asia/Bangkok");
			// $time = date("Y-m-d H:i:s");
			// echo "<p>$time</p>";
			echo "<a href=\"myresult.php\" target=\"_blank\">Test history</a>";
		?>
	</div>
</div>
<script type="text/javascript">setTimeout(function(){initUI()},100);</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	function makeid() {
		let tzoffset = (new Date()).getTimezoneOffset() * 60000;
        let d = new Date(Date.now() - tzoffset).toISOString();
        return d;
    }

	function showData(){
        var dx = document.getElementById("dataArea");
        if (dx.style.display === "block") {
                dx.style.display = "none";
        } else {
                dx.style.display = "block";
        }
    }
        
    $(document).ready(function(){
		$("#startStopBtn").click(function(){
			let name = makeid();
			$.post("http://localhost:8080/testcode.php",
				{
					name: name
				},
				function(res,status){
					let data = JSON.parse(res);
					$("#testcode").html(data.message);
				}
			)
		})
    })
</script>
</body>
</html>
