<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}

$question = sanitize_string($_POST['question']);
$xp = sanitize_string($_POST['xp']);
$matchid = sanitize_string($_POST['matchid']);
$ca = 0;
if (isset($_POST['correctanswer_radio'])){
	$ca = sanitize_string($_POST['correctanswer_radio']);
}
$specialid = sanitize_string($_POST['specialid']);
$special = new questions($specialid);

$special->setMatchID($matchid);
$special->setQuestion($question);
$special->setCorrectAnswer($ca);
$special->setXP($xp);
$special->update();

header("Location: /index.php?a=administration&b=specialbets&id=".$matchid);

?>