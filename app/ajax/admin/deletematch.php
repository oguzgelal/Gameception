<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}
$matchid = sanitize_string($_POST['matchid']);
$match = new matches($matchid);
$match->delete();
echo getMessage("S25");
?>