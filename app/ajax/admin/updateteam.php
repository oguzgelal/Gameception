<?php
$action = "";
if (isset($_POST['action'])){ $action = sanitize_string($_POST['action']); }
$teamid = "";
if (isset($_POST['teamid'])){ $teamid = sanitize_string($_POST['teamid']); }
$teamname = "";
if (isset($_POST['teamname'])){ $teamname = sanitize_string($_POST['teamname']); }
$teamtype = "";
if (isset($_POST['teamtype'])){ $teamtype = sanitize_string($_POST['teamtype']); }
$imgname = "";
if (isset($_POST['imgname'])){ $imgname = sanitize_string($_POST['imgname']); }


if ($_FILES['teamphoto']['name'] != ""){
	$teamphoto = $_FILES['teamphoto'];
	if (validFile($teamphoto)){
		if ($action == "update" && $imgname!=""){ removeOldPhoto($imgname, TEAMPHOTOS);	}
		$imgname = moveFileTo($teamphoto, TEAMPHOTOS);
	}
	else{
		echo getMessage("E29");
		exit();
	}
}

if ($action == "update"){ $team = new gamers($teamid); }
else if ($action == "insert"){ $team = new gamers(); }

$team->setType($teamtype);
$team->setName($teamname);
$team->setImage($imgname);
$team->setActive(1);

if ($action == "update"){ $team->update(); }
else if ($action == "insert"){ $team->insert(); }

header("Location: /index.php?a=administration&b=takimlar");




?>