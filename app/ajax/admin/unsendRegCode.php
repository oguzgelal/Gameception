<?php
if (isAdminLoggedIn()){
	$id = $_POST['codeid'];
	$pdo = newPDO();
	$query = $pdo->prepare("UPDATE ".REGCODES." SET sent=:sent WHERE id=".$id);
	$query->execute(array(':sent'=>'0'));
}	
?>