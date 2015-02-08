<?php
require 'src/facebook.php';

define( "DB_NAME", "gception_gception" );
define( "DB_USER", "gception_ggc" );
define( "DB_PASSWORD", "ggception" );
define( "DB_HOST", "localhost" );
define( "REGCODES", "regcodes" );

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function newPDO(){
	try { $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); } 
	catch (PDOException $e) { echo getMessage("E0"); }
	return $pdo;
}

$facebook = new Facebook(array(
	'appId'  => '1437461526501525',
	'secret' => '8f24331109f1a2925ab8c4d0f6de5e97',
	));

try {
	$user = $facebook->getUser();
	if ($user) {
		try { $user_profile = $facebook->api('/me'); }
		catch (FacebookApiException $e) {
			error_log($e);
			$user = null;
		}
	}
	$likes = $facebook->api("/me/likes/273129442854340");
}
catch(FacebookApiException $e){	$user = null; }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Gameception</title>
	<meta charset="utf-8" />
	<style>
	body{
		font-family:arial;
		margin:0; padding:0;
		background:#01030f url(bg_res.jpg) no-repeat center top;
	}

	a {
		color: white;
		text-decoration: none;
	}

	.logo_res{
		margin:2% auto;
		width:359px;
		height:256px;
		background:url(logo.png) no-repeat;
		margin-left:auto;
		margin-right:auto;
	}

	.login_yazi{
		padding:20px 10px 10px 10px;
		background:url(bg_yazi.png);
		font-weight:bold;
		margin:2% auto;
		width:600px;
		color:#dfe3e6;
		margin-left:auto;
		margin-right:auto;
	}

	#btn {
		-webkit-transition: all 0.3s linear;
		-moz-transition:all 0.3s linear;
		-o-transition: all 0.3s linear;
		-transition: all 0.3s linear;
		width:216px;
		height:20px;
		padding:0;
		border:none;
		opacity:0.9;
	}
	#btn:hover{
		cursor:pointer;
		-webkit-transition: all 0.3s linear;
		-moz-transition:all 0.3s linear;
		-o-transition: all 0.3s linear;
		-transition: all 0.3s linear;
		opacity:1;
	}
	</style>
</head>
<body>

	<div class="logo_res"></div>
	<div class="login_yazi" align="center">

		<?php

		if ($user) {
			echo "<div id='btn' class='a'>Merhaba, ".$user_profile['name']."</div>";

			$likes = $facebook->api("/me/likes/273129442854340");
			$cntlikes = count($likes['data']);
			if ($cntlikes == 0){
				?>
				<div id='btn' class='b'>
					<u><a href='#' style="font-size:10px;" onClick="document.location.reload(true)">Sayfamızı beğendikten buraya sonra tıkla.</a></u>
					<iframe class="iframelike" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fggception&amp;width&amp;height=62&amp;colorscheme=dark&amp;show_faces=false&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=210205559160899" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:62px;" allowTransparency="true"></iframe>
				</div>
				<?php
			}
			else{
				echo "<div id='btn' class='a'><h4 style='color:green;'>Facebook sayfamızı beğendin.</h4></div>";

				$insertCode = generateRandomString(15);
				$pdo = newPDO();
				$query = $pdo->prepare("INSERT INTO ".REGCODES." VALUES( :id, :regCode, :sent, :used, :blocked, :registered_email )");
				$query->execute(array(':id'=>'', ':regCode'=>$insertCode, ':sent'=>'0', ':used'=>'0', ':blocked'=>'0', ':registered_email'=>''));
				
				echo " <a href='http://www.gception.com/index.php?a=register&invcode=".$insertCode."' target='_new'> <div id='btn' class='c'> <h3> <span stlye='color:gray;'>Davet kodunuz : </span> <span style='color:white;'>".$insertCode."</span> </h3> </div> </a> ";
			}
			
		} 
		else {
			$loginUrl = $facebook->getLoginUrl();
			echo "<div id='btn' class='a'><a href='".$loginUrl."'>Facebook ile giriş yap.</a></div>";
		}

		?>

		<div id="btn" class="a"></div>
		<div id="btn" class="b"></div>
		<div id="btn" class="c"></div>


	</div>
</body>
</html>