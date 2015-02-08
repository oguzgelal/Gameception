<?php
// Simple security check
if (!isAdminLoggedIn()){ exit(); }
if ( !isset( $ping ) || $ping != "pong" ) { exit(); }

include_once ACTIONS . "/public/_htmlstart.php";
include_once ACTIONS . "/public/_header.php";
include_once ACTIONS . "/admin/_adminmenu.php";
?>

<!-- Contents -->
<section class="container section">
	<div class="row" style="color:white;">

		<?php

		$pdo = newPDO();

		$query_memcnt = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_PROFILE);
		$query_memcnt->execute();
		$memcnt = $query_memcnt->fetchColumn();

		$query_mtccnt = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_MATCHES);
		$query_mtccnt->execute();
		$mtccnt = $query_mtccnt->fetchColumn();

		$query_kpcnt = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_KUPON);
		$query_kpcnt->execute();
		$kpcnt = $query_kpcnt->fetchColumn();

		$query_kpcnt_t = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_KUPON." WHERE checked = '1'");
		$query_kpcnt_t->execute();
		$kpcnt_t = $query_kpcnt_t->fetchColumn();

		$query_kpcnt_f = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_KUPON." WHERE checked = '2'");
		$query_kpcnt_f->execute();
		$kpcnt_f = $query_kpcnt_f->fetchColumn();

		$query_kpcnt_u = $pdo->prepare("SELECT COUNT(*) FROM ".TABLE_KUPON." WHERE checked = '0'");
		$query_kpcnt_u->execute();
		$kpcnt_u = $query_kpcnt_u->fetchColumn();

		echo "Üye sayısı : ".$memcnt;
		echo "<br>";
		echo "Maç sayısı : ".$mtccnt;
		echo "<br>";
		echo "Kupon sayısı : ".$kpcnt;
		echo "<br>";
		echo "Tutan Kupon sayısı : ".$kpcnt_t;
		echo "<br>";
		echo "Yatan Kupon sayısı : ".$kpcnt_f;
		echo "<br>";
		echo "Sonuçlanmamış Kupon sayısı : ".$kpcnt_u;
		echo "<br>";

		?>

	</div>
</section>


<?php
include_once ACTIONS . "/public/_footer.php";
include_once ACTIONS . "/public/_htmlend.php";
?>

