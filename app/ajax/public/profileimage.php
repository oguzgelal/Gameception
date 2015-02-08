<?php

if (isset($_SESSION['userid']) && $_FILES['profileimage']['name'] != ""){
	$profileid = $_SESSION['userid'];
	$user = new profile($profileid);
	$imgname = $user->image;
	$image = $_FILES['profileimage'];
	if (validFile($image)){
		if ($imgname!="" && $imgname!=DEFAULTIMG){ removeOldPhoto($imgname, AVATAR); }
		$imgname = moveFileTo($image, AVATAR);
		$user->setImage($imgname);
		$user->update();
	}
	else{
		addNotif($profileid, getMessage("E29"));
	}
}

header("Location: /index.php?a=profile");
?>