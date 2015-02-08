<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";

$regcode = "";
if (isset($_GET['invcode'])){
	$regcode = $_GET['invcode'];
}

?>

<!-- Contents -->
<section class="container section">
	<div class="row" style="margin-top:0px;">
		<div class="col-xs-12">
			<h2 style="color:white;margin-left:20px;">Kayıt Ol</h2>
		</div>
		<div class="col-xs-12 text-right">
			<div class="division formcontainer">
				<div class="alert alert-success text-center registrationCompleted" style="display:none;">
					Kayıt işleminiz başarıyla tamamlandı. Şimdi üye girişi yapabilirsiniz.
				</div>

				<form role="form" class="form-horizontal reg_form" method="post">
					<br><br>
					<!--
					<div class="form-group">
						<label for="reg_invite" class="col-xs-2">Davet Kodu</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="reg_invite" id="reg_invite" placeholder="Size gönderilen davet kodunu giriniz." value="<?php echo $regcode; ?>">
						</div>
					</div>
				-->
					<div class="form-group">
						<label for="reg_name" class="col-xs-2">Ad</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="reg_name" id="reg_name">
						</div>
						<label for="reg_surname" class="col-xs-1">Soyad</label>
						<div class="col-xs-4">
							<input type="text" class="form-control" name="reg_surname" id="reg_surname">
						</div>
					</div>
					<div class="form-group">
						<label for="reg_nick" class="col-xs-2">Nick</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="reg_nick" id="reg_nick">
						</div>
					</div>
					<div class="form-group">
						<label for="reg_email" class="col-xs-2">Email</label>
						<div class="col-xs-9">
							<input type="email" class="form-control" name="reg_email" id="reg_email">
						</div>
					</div>
					<div class="form-group">
						<label for="reg_password" class="col-xs-2">Password</label>
						<div class="col-xs-9">
							<input type="password" class="form-control" name="reg_password" id="reg_password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-11">
							<button type="button" class="btn btn-success reg_submit">Gönder</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>

<?php
include_once dirname(__FILE__) . "/_footer.php";
include_once dirname(__FILE__) . "/_htmlend.php";
?>