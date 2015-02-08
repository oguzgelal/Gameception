<?php
if (isset($_SESSION['coupon'])){
	echo json_encode($_SESSION['coupon']);
}