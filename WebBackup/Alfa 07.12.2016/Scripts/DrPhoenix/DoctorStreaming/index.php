<?php
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    return $ip;
}

//Get Visitor IP
$user_ip = getUserIP();

//Unset Visitor Time Cookie
if(isset($_COOKIE["t0"])){
    unset($_COOKIE["t0"]);
    setcookie("t0",null,-1,"/");
}
//Set Visitor Time Cookie to time()
setcookie("t0", time()*1000);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Doctor Streaming</title>
		<link rel="icon" type="image/png" href="../img/icon.png" />
		<link rel="stylesheet" href="../style.css">
		<link rel="stylesheet" href="../fonts.css">
		<link rel="stylesheet" href="style.css">
	</head>
	
	<body onbeforeunload="do_update()">
		<div class="content">
			<div class="nav">
				<?php include("../menu.php"); ?>
			</div>
			
			<div class="main">
				<center><img src="logo.png" class="logo"></center>
				
				<h1 class="title">Features</h1>
					<ul class="list">
						<li>Hide announcer on kill or death</li>
						<li>Hide names on tab list</li>
						<li>Hide names on top of health bar</li>
					</ul>
				
				<h1 class="title">Download</h1>
					<center><a href="http://s1mplescripts.de/DrPhoenix/BoL/Scripts/DoctorStreaming/DoctorStreaming.lua" download class="download_link">Direct download link, direct challenger promotion !</a></center>
					<center><a href="https://forum.botoflegends.com/topic/95489-free-utility-doctor-streaming/" class="download_link">Visit the forum thread to see what users said about it !</a></center>
				
				<h1 class="title">Credits</h1>
					<div class="credits">
						<p><a href="https://forum.botoflegends.com/user/494545-s1mple/" class="credits_name contributor">S1mple</a> for his amazing download class !</p>
					</div>
			</div>
			
			<div class="push"></div>
		</div>
		
		<div class="footer">
			<p>2016 © Doctor Phoenix</p>
			<p>Site coded and designed by <a href="http://www.s1mplescripts.de/DrPhoenix/">Doctor Phoenix</a></p>
		</div>
		
		<script>
			function do_update() {
				var xhttp = new XMLHttpRequest();
				var d = new Date();
				var currentTime = d.getTime();
				var entryTime = getCookie("t0");
				var siteTime = currentTime-entryTime;
				xhttp.open("GET", "http://s1mplescripts.de/WebTracker/do_updateTracker.php?ip=<?php echo $user_ip?>&time="+siteTime, true);
				xhttp.send();
			}

			function getCookie(name) {
				var value = "; " + document.cookie;
				var parts = value.split("; " + name + "=");
				if (parts.length == 2) return parts.pop().split(";").shift();
			}
		</script>
	</body>
</html>