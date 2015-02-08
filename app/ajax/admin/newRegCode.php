<?php
if (isAdminLoggedIn()){
	$insertCode = generateRandomString(15);
	$pdo = newPDO();
	$query = $pdo->prepare("INSERT INTO ".REGCODES." VALUES( :id, :regCode, :sent, :used, :blocked, :registered_email )");
	$query->execute(array(':id'=>'', ':regCode'=>$insertCode, ':sent'=>'0', ':used'=>'0', ':blocked'=>'0', ':registered_email'=>''));
}	
?>