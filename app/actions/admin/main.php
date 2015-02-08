<?php
// Simple security check
if (!isAdminLoggedIn()){ exit(); }
if ( !isset( $ping ) || $ping != "pong" ) { exit(); }

include_once ACTIONS . "/public/_htmlstart.php";
include_once ACTIONS . "/public/_header.php";
include_once ACTIONS . "/admin/_adminmenu.php";
?>

<!-- Contents -->
<div class="container section">

		<!-- Main Page Item -->
		<div class="row">
			<div class="col-xs-12 text-center">
				<?php
				$pdo = newPDO();
				$query = $pdo->prepare("SELECT item FROM ".MAINPAGE_ITEM." LIMIT 1");
				$query->execute();
				$results = $query->fetch();
				?>
				<h3 style="color:white;">Main Page Item</h3>
				<textarea name="mainpageitem" id="mainpageitem" class="form-control" style="width:100%;height:150px;"><?php echo $results['item']; ?></textarea>
				<div style="width:100%; text-align:right;">
					<input type="button" class="btn btn-sm btn-success" id="mainpageitemchange" style="margin-top:10px;" value="Kaydet">
				</div>
			</div>
		</div>
	</div>


	<?php
	include_once ACTIONS . "/public/_footer.php";
	include_once ACTIONS . "/public/_htmlend.php";
	?>