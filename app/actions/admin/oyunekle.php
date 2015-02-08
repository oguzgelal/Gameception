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
	<div class="row">
		<div class="col-xs-12">

		</div>
	</div>
</div>


<?php
include_once ACTIONS . "/public/_footer.php";
include_once ACTIONS . "/public/_htmlend.php";
?>