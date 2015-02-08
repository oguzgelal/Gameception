<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}
$questionid = sanitize_string($_POST['questionid']);
$question = new questions($questionid);
$question->delete();
echo getMessage("S27");
?>