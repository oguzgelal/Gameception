<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
?>

<!-- Footer -->
<footer class="container footer">
	<div class="row">
		<div class="col-xs-12 text-center footer" style="background: url('img/bg.jpg'); background-size: 100% auto;">
			<br>
			<div class="sociallogos">
				<a href="https://www.facebook.com/pages/Gameception/273129442854340" target="_new"><img src="/img/fb.png" alt=""></a>
				<a href="https://twitter.com/gception" target="_new"><img src="/img/tt.png" alt=""></a>
			</div>
			<?php
			if (isset($_GET['a']) && $_GET['a']=="stream" && isAdminLoggedIn()){
				$matchid = "";
				if (isset($_GET['b'])){
					$matchid = sanitize_string($_GET['b']);
					echo "<a href='/index.php?a=administration&b=macekle&id=".$matchid."'>Edit this match</a><br>";
					echo "<a href='/index.php?a=administration&b=specialbets&id=".$matchid."'>Special bets</a>";
				}
			}
			?>
			
			<div class="warningtext">
				Takım logoları takımların kendisine, oyunlar ve  ilgili materyaller ise oyun firmalarına  aittir. Sitenin takımlar ve oyun firmaları ile hiçbir bağlantısı yoktur.
			</div>
		</div>
	</div>
</footer>