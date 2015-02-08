<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
  exit();
}
include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";
?>

<!-- Contents -->
<section class="container section">
	<div class="row">
		
	</div>
</section>

<?php
include_once dirname(__FILE__) . "/_footer.php";
include_once dirname(__FILE__) . "/_htmlend.php";
?>