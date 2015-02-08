<?php
if (!isAdminLoggedIn()){
	echo getMessage("E24");
	exit();
}

$editmode = sanitize_string($_POST['editmode']);
$answer_txt = sanitize_string($_POST['answer']);
$rate = sanitize_string($_POST['rate']);
$questionid = sanitize_string($_POST['questionid']);

// create new object or load existing
if ($editmode == -1){ $answer = new answers(); }
else{ $answer = new answers($editmode); }

$answer->setQuestionID($questionid);
$answer->setAnswer($answer_txt);
$answer->setRate($rate);

// insert or update the edited object to the database
if ($editmode == -1){ $editmode = $answer->insert(); }
else{ $answer->update(); }

if ($editmode == 0 || $editmode == -1){
	echo getMessage("E26");
	exit();
}
else{
	echo "S:".$editmode;
	exit();
}

// test
//echo $editmode." ".$answer_txt." ".$rate." ".$questionid;

?>