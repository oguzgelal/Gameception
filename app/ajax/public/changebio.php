<?php
if (isset($_SESSION['userid']) && isset($_POST['biotextarea']) && $_POST['biotextarea']!=""){
	$userid_changebio = $_SESSION['userid'];
	$user_changebio = new profile($userid_changebio);
	$newbio = sanitize_string($_POST['biotextarea']);
	if (strlen($newbio) > 140){
		addNotif($userid_changebio, getMessage("E30"));
	}
	else{
		$user_changebio->setBio($newbio);
		$user_changebio->update();
	}
}

header("Location: /index.php?a=profile");
?>