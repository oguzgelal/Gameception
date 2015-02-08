<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
?>

<!-- Header -->
<nav class="navbar navbar-default navbar-fixed-top" style="background: url('img/bg.jpg'); background-size: 100% auto;" role="navigation">
	<!--
	<div class="logo">
		<a href="/index.php?a=main"><img src="img/logo.png" class="logoimg"></a>
	</div>
-->
<div class="container">
	<div class="col-xs-2 text-left">
		<a href="/index.php?a=main"><img src="img/logo.png" class="logoimg"></a>
	</div>
	<div class="col-xs-7 text-center menucont">
		<ul class="list-inline list-unstyled menuul">
			<li><a class="menulink" href="/index.php?a=main">Ana Sayfa</a></li>
			<?php
			if(isLoggedIn()){ echo "<li><a class='menulink' href='/index.php?a=profile&id=".$_SESSION['userid']."'>Profil</a></li>"; }
			else { echo "<li><a class='menulink' href='/index.php?a=register'>Profil</a></li>"; }
			?>
			
			<li><a class="menulink" href="/index.php?a=bahis">Fikstür</a></li>
			<li><a class="menulink" href="/index.php?a=siralama">Siralama</a></li>
			<!--<li><a class="menulink" href="/index.php?a=store">Store</a></li>-->
			<?php if (isAdminLoggedIn()){ ?><li><a class="menulink" href="/index.php?a=administration">Admin</a></li><?php }?>
		</ul>
	</div>
	<div class="col-xs-3">
		<!-- DESIGN -->
		<!-- keep username in input(text) .logindata#username -->
		<!-- keep username in input(text) .logindata#password -->
		<!-- keep login button as input(button) #loginbutton -->
		<!-- keep logout button as input(button) #logoutbutton -->
		<?php
		if (isLoggedIn()){ 
			$userid_header = $_SESSION['userid'];
			$user_header = new profile($userid_header);
			$displayname = $user_header->getDisplayName();
			?>
			<div class="menuloginlink">
				<div class="menulogin_col1 text-right">
					<div class="menulogin_row1"></div>
					<div class="menulogin_row2"></div>
				</div>
				<div class="menulogin_col2">
					<div class="menulogin_row1">Merhaba,</div>
					<div class="menulogin_row2"><a href='/index.php?a=profile&id=<?php echo $userid_header; ?>'><b><?php echo $displayname; ?></b></a></div>
					<div class="menulogin_row3"><input type="button" id="logoutbutton" value="Çıkış"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } else { ?>
			<div class="menuloginlink">
				<div class="menulogin_col1 text-right">
					<div class="menulogin_row1"><input type="text" class="logindata" name="username" id="username" placeholder="Nick"></div>
					<div class="menulogin_row2"><input type="password" class="logindata" name="password" id="password" placeholder="Şifre"></div>
				</div>
				<div class="menulogin_col2">
					<div class="menulogin_row1"><input type="checkbox" class="logindata" id="rememberme" style="margin:0; margin-right:5px;">Beni Hatırla</div>
					<div class="menulogin_row2"><input type="button" id="loginbutton" value="Giriş"><input type="button" id="kayitolbutton" value="Kayıt Ol"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php } ?>
		</div>
	</div>

	<div class="loginform">
		<form class="form text-right" role="form">
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">Email</label>
				<input type="email" class="form-control input-sm" id="exampleInputEmail2" placeholder="Email adresi">
			</div>
			<div class="form-group">
				<label class="sr-only" for="exampleInputPassword2">Şifre</label>
				<input type="password" class="form-control input-sm" id="exampleInputPassword2" placeholder="Şifre">
			</div>
			<button type="submit" class="btn btn-default btn-xs signinbutton">Giriş</button>
		</form>
	</div>
</nav>
