<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}

if (!isset($_GET['id'])){ header('Location: /index.php'); exit(); }
else { $kuponid = sanitize_string($_GET['id']); }
$kupon = new kupon($kuponid);

include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";
?>

<!-- Contents -->
<section class="container section">
	<div class="row">
		<div class="col-xs-12">
			<?php echo $kupon->getCouponHTML(); ?>
		</div>
	</div>
</section>

<script>
</script>

<?php
include_once dirname(__FILE__) . "/_footer.php";
include_once dirname(__FILE__) . "/_htmlend.php";
?>