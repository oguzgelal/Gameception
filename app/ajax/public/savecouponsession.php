<?php
$_SESSION['coupon_saved'] = 1;
if (isset($_POST['coupon'])){
	// sanitize coupon data
	$currentcoupon_unsafe = $_POST['coupon'];
	$currentcoupon = array();
	try {
		foreach($currentcoupon_unsafe as $us){
			$ss = sanitize_string($us);
			array_push($currentcoupon, $ss);
		}
	}
	catch(Exception $e){
		echo getMessage("E6");
		exit();
	}
	// save to session
	$_SESSION['coupon'] = $currentcoupon;
}
else {
	$_SESSION['coupon'] = array();
}