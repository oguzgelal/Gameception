<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}

$mainitem = $_POST['mainitem'];
echo $mainitem;
$pdo = newPDO();
$query = $pdo->prepare("UPDATE ".MAINPAGE_ITEM." SET `item` = :item");
$query->execute(array(':item'=>$mainitem));
?>