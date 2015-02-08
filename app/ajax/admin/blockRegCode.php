<?php
if (isAdminLoggedIn()){
	$id = $_POST['codeid'];
	$pdo = newPDO();
	$query = $pdo->prepare("UPDATE ".REGCODES." SET blocked=:blocked WHERE id=".$id);
	$query->execute(array(':blocked'=>'1'));
}	
?>