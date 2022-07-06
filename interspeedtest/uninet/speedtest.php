
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
			?>
		</div>

		<p id="testcode"></p>
		<div id="shareArea" style="display:none"></div>
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
    $(document).ready(function(){
		$("#startStopBtn").click(function(){
			let name = makeid();
			$.post("http://localhost:8080/uninet/testcode.php",
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
