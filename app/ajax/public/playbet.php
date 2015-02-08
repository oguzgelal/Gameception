<?php

$minmatches = 1;

// check login
if (!isLoggedIn()){
	echo getMessage("E4");
	exit();
}
// check inputs
if ( !isset($_POST['deposit']) || !isset($_POST['selections']) || $_POST['deposit']=="0" ){
	echo getMessage("E5");
	exit();
}
// match count check
$unsafe_selections = $_POST['selections'];
if (count($unsafe_selections) < $minmatches){
	echo getMessage("E7");
	exit();
}
// sanitize selections
$selections_match = array(); //[match_id]=>[selection_id]
$selections_question = array(); //[question_id]=>[answer_id]
try {
	foreach($unsafe_selections as $us){
		$ss = sanitize_string($us);
		$exploded = explode(":", $ss);
		if (is_array($exploded) && count($exploded)==3){ 
			if ($exploded[0]==0){ $selections_match[$exploded[1]] = $exploded[2]; }
			else if ($exploded[0]==1){ $selections_question[$exploded[1]] = $exploded[2]; }
			else{
				echo getMessage("E15");
				exit();	
			}
		}
		else {
			echo getMessage("E15");
			exit();
		}
	}
}
catch(Exception $e){
	echo getMessage("E6");
	exit();
}

// create user object from session
$userid_playbet = $_SESSION['userid'];
$user_playbet = new profile($userid_playbet);
// id valid
if ($user_playbet->found == 0){
	echo getMessage("E9");
	exit();
}
// account active
if ($user_playbet->active == 0){
	echo getMessage("E13");
	exit();
}
// check deposit amount
$deposit = sanitize_string($_POST['deposit']);
if (!is_numeric($deposit)){
	echo getMessage("E8");
	exit();
}
// deposit validity check
if ($deposit <= 0){
	echo getMessage("E36");
	exit();
}
// user money check
if ($user_playbet->money < $deposit){
	echo getMessage("E11");
	exit();
}

// check matches
foreach($selections_match as $m => $ms){
	checkMatches($m);
	checkSelections($ms);
}
// check questions
foreach($selections_question as $q => $a){
	$question = new questions($q);
	$answer = new answers($a);

	if ($question->found==0){
		echo getMessage("E19");
		exit();
	}
	if ($answer->found==0){
		echo getMessage("E20");
		exit();
	}
	if ($answer->question_id != $question->id){
		echo getMessage("E23");
		exit();
	}
	checkMatches($question->match_id);
}

// create coupon and insert matches
$kupon = new kupon();
$kupon->setProfileID($userid_playbet);
$kupon->setSpent($deposit);
$kupon->insert();
foreach($selections_match as $m => $ms) {
	$add = $kupon->addMatch($m , $ms);
	if ($add == 0){
		echo getMessage("E21");
		exit();
	}
}
foreach($selections_question as $q => $a) {
	$add = $kupon->addQuestion($q , $a);
	if ($add == 0){
		echo getMessage("E22");
		exit();
	}
}


// decrement user money
$user_playbet->setMoney($user_playbet->money - $deposit);
$updateuser = $user_playbet->update();
if ($updateuser){
	echo getMessage("S18");
	exit();
}
else{
	echo getMessage("E6");
	exit();	
}



function checkMatches($matchid){
	$match = new matches($matchid);
	// id valid
	if ($match->found == 0){
		echo getMessage("E10");
		exit();
	}
	// active
	if ($match->active == 0){
		echo getMessage("E12");
		exit();
	}
	// match passed check
	if (!$match->notPassed()){
		echo getMessage("E16");
		exit();
	}
}

function checkSelections($selection){
	// selection check
	if ($selection!="1" && $selection!="2"){
		echo getMessage("E15");
		exit();
	}
}

?>