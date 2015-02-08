<?php
if (isset($_SESSION['coupon_saved'])){
	unset($_SESSION['coupon_saved']);
}
if (isset($_SESSION['coupon'])){
	unset($_SESSION['coupon']);
}