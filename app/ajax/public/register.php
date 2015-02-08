<?php

if(!isLoggedIn()){

	//if (!isset($_POST['reg_invite']) || $_POST['reg_invite']==""){ echo getMessage("E31"); exit(); }
	if (!isset($_POST['reg_name'])  || $_POST['reg_name']=="" ){ echo getMessage("E31"); exit(); }
	if (!isset($_POST['reg_surname'])  || $_POST['reg_surname']=="" ){ echo getMessage("E31"); exit(); }
	if (!isset($_POST['reg_nick'])  || $_POST['reg_nick']=="" ){ echo getMessage("E31"); exit(); }
	if (!isset($_POST['reg_email'])  || $_POST['reg_email']=="" ){ echo getMessage("E31"); exit(); }
	if (!isset($_POST['reg_password'])  || $_POST['reg_password']=="" ){ echo getMessage("E31"); exit(); }

	//$reg_invite = sanitize_string($_POST['reg_invite']);
	$reg_name = sanitize_string($_POST['reg_name']);
	$reg_surname = sanitize_string($_POST['reg_surname']);
	$reg_nick = sanitize_string($_POST['reg_nick']);
	$reg_email = sanitize_string($_POST['reg_email']);
	$reg_password = sanitize_string($_POST['reg_password']);

	/*
	if (!validInvite($reg_invite)){
		echo getMessage("E33");
		exit();
	}
	*/
	if (!validEmail($reg_email)){
		echo getMessage("E32");
		exit();
	}
	if (!validNick($reg_nick)){
		echo getMessage("E34");
		exit();
	}

	$profile = new profile();
	$profile->setName($reg_name);
	$profile->setSurname($reg_surname);
	$profile->setNick($reg_nick);
	$profile->setEmail($reg_email);
	$profile->setPass($reg_password);
	$profile->setType("1");
	$profile->setImage(DEFAULTIMG);
	$profile->setBio($reg_name." ".$reg_surname);
	$profile->setLevel(0);
	$profile->setXP(0);
	$profile->setMoney(DEFAULTMONEY);
	$profile->setTotalMoney(0);
	$profile->setMatchesWon(0);
	$profile->setMatchesLost(0);
	$profile->setQuestionsWon(0);
	$profile->setQuestionsLost(0);
	$profile->setKuponWon(0);
	$profile->setKuponLost(0);
	$profile->setRegdate(time());
	$profile->setActive(1);
	$ins = $profile->insert();

	if ($ins){
		//useInvite($reg_invite, $reg_email);
		// GIVE CLOSED BETA BADGE
		//$profile->giveBadge(CLOSEDBETABADGE);
		echo getMessage("S35");
		exit();
	}
	else{
		echo getMessage("E35");
		exit();
	}
}

// FUNCTIONS

/*
function validInvite($invite){
	$pdo = newPDO();
	$query = $pdo->prepare("SELECT * FROM ".REGCODES." WHERE regCode=:regCode LIMIT 1");
	$query->execute(array(':regCode'=>$invite));
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	if (count($results) <= 0) { return false; }
	else{
		$used = $results[0]['used'];
		$blocked = $results[0]['blocked'];
		if ($used=="0" && $blocked=="0"){ return true; }
		else{ return false; }
	}
}
function useInvite($invite, $email){
	$pdo = newPDO();
	$query = $pdo->prepare("UPDATE ".REGCODES." SET `registered_email`=:regmail, `used`=:used WHERE `regCode`=:regCode");
	$query->execute(array(':regmail'=>$email,':used'=>'1',':regCode'=>$invite));
}
*/
function validEmail($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ return false; }
	else{
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." WHERE email=:email LIMIT 1");
		$query->execute(array(':email'=>$email));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { return false; }
		else{ return true; }
	}
}

function validNick($nick){
	$pdo = newPDO();
	$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE." WHERE nick=:nick LIMIT 1");
	$query->execute(array(':nick'=>$nick));
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	if (count($results) > 0) { return false; }
	else{ return true; }
}

?>