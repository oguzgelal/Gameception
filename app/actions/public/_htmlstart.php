<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Gameception</title>
	<meta property="og:image" content="/img/logofb.png"/>
	<meta property="og:title" content="Gameception"/>
	<meta property="og:url" content="http://www.gception.com"/>
	<meta property="og:site_name" content="Gameception"/>


	<link rel="icon" type="image/png" href="/img/fav.png">
	<link rel="image_src" href="/img/logofb.png">

	<link rel="stylesheet" href="/css/bootstrap.css">
	<link rel="stylesheet" href="/css/custom.css">
	<link rel="stylesheet" href="/css/navbar.css">
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/bahis.css">
	<link rel="stylesheet" href="/css/stream.css">
	<link rel="stylesheet" href="/css/profile.css">
	<link rel="stylesheet" href="/css/kupon.css">
	<link rel="stylesheet" href="/css/register.css">
	<?php if (isAdminLoggedIn()){ ?> <link rel="stylesheet" href="/css/adm_main.css"> <?php } ?>
	<script src="/js/jquery.js"></script>
	<script src="/js/jquery_migrate.js"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/scripts.js"></script>
	<script src="/js/slider.js"></script>
	<script src="/js/kupon.js"></script>
	<script src="/js/headers.js"></script>
	<script src="/js/html2canvas.js"></script>
	<script src="/js/canvas2image.js"></script>
	<script src="/js/canvassaver.js"></script>
	<script src="/js/base64.js"></script>
	<script src="/js/register.js"></script>
	<?php if (isAdminLoggedIn()){ ?> <script src="/js/adm_main.js"></script> <?php } ?>
	
	<!-- Google Analytics -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-49685262-1', 'gception.com');
	ga('send', 'pageview');

	</script>

</head>
<body>
	
	<!-- NEW SERVER -->

	<!-- Social Media Icons -->
	<div class="sociallogos_top">
		<a href="https://www.facebook.com/pages/Gameception/273129442854340" target="_new"><img src="/img/fb.png" alt=""></a>
		<a href="https://twitter.com/gception" target="_new"><img src="/img/tt.png" alt=""></a>
	</div>

	<!-- Notifications -->
	<div class="dismissnotifs">
		<?php
		// NOTIF CHECKS
		if ( !isset($_SESSION['lastnotifupdate']) ){
			error_log("notif... ".time());
			notifchecker();
			$_SESSION['lastnotifupdate'] = time();
		}
		else{
			if (time() - $_SESSION['lastnotifupdate'] > NOTIF_INTERVAL){
				error_log("notif... ".time());
				notifchecker();
				$_SESSION['lastnotifupdate'] = time();
			}
		}
		?>
	</div>

