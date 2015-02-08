<?php

/* EXECUTION METHODS */

// this method will be executed on every refresh and it will execute its contents once every 30 days
function monthlyExecution(){
	// refresh days interval in seconds
	$pdo = newPDO();
	$query = $pdo->prepare("SELECT last FROM ".TABLE_MONTHLY_EXECUTION." LIMIT 1");
	$query->execute();
	$fetched = $query->fetch();
	$last = $fetched['last'];
	// if one month passed since the last execution
	if (time() - $last >= MONTHINSECS){
		transferMonthlyToTotal();
		// update last execution date
		$query = $pdo->prepare("UPDATE ".TABLE_MONTHLY_EXECUTION." SET last=".time());
		$query->execute();
	}
}

// this method will be executed on every refresh and it will execute its contents once every day
function dailyExecution(){
	// refresh days interval in seconds
	$pdo = newPDO();
	$query = $pdo->prepare("SELECT last FROM ".TABLE_DAILY_EXECUTION." LIMIT 1");
	$query->execute();
	$fetched = $query->fetch();
	$last = $fetched['last'];
	// if one month passed since the last execution
	if (time() - $last >= DAYSINSECS){
		resetMoney();
		// update last execution date
		$query = $pdo->prepare("UPDATE ".TABLE_DAILY_EXECUTION." SET last=".time());
		$query->execute();
	}
}

// this method will be executed on every refresh (and ajax call) and it will execute its contents on every refresh (and ajax call)
function refreshExecution(){
	checkPlayedStuff();
}

// this method is being called on every successful login
function loginExecution(){
	checkMemberBadge();
	setLevel();
	checkLevelBadge();
}

/* METHODS GOES IN EXEC METHODS */

// check coupons matches and questions
function checkPlayedStuff(){
	if (isLoggedIn()){
		$profile = new profile($_SESSION['userid']);
		// check UNCHECKED coupons (only coupons, not matches or questions) of current user
		$profile->checkCoupons();
		// check UNCHECKED matches and questions seperately from their coupons
		$profile->checkMatches();
		$profile->checkQuestions();
	}
}

// transfer monthly money to total money
function transferMonthlyToTotal(){
	$users = profile::LoadAll();
	foreach($users as $u){
		$user_transfer = new profile($u['id']);
		$user_transfer->transferMonthlyToTotal();
	}
}

// reset money of the users that has less than 500 credit
function resetMoney(){
	$pdo = newPDO();
	$query = $pdo->prepare("SELECT id FROM ".TABLE_PROFILE." WHERE money < ".DEFAULTMONEY);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $r){
		$profid = $r['id'];
		$user_rm = new profile($profid);
		$user_rm->setMoney(DEFAULTMONEY);
		$user_rm->update();
	}
}

// update level of the user
function setLevel(){
	if (isLoggedIn()){
		$levels = array(0,20,50,90,150,250,350,450,550,650,1000,1500,2000,2500,3000,3500,4000,4500,5000,5500,6000,6500,7000,7500,8000,8500,9000,9500,10000,10500,11000,11500,12000,12500,13000,13500,14000,14500,15000,15500,16000,16500,17000,17500,18000,18500,19000,19500,20000,20500);
		$userid_setlevel = $_SESSION['userid'];
		$user_setlevel = new profile($userid_setlevel);
		$userxp = $user_setlevel->xp;

		$levelindex = 0;
		while($userxp >= $levels[$levelindex]){
			$levelindex++;
			if ($levelindex >= count($levels)){ break; }
		}
		if ($user_setlevel->level != $levelindex){
			$user_setlevel->setLevel($levelindex);
			$user_setlevel->update();
			// add notification
			addNotif($user_setlevel->id, "Level artışı: Yeni level ".($levelindex));
		}
	}	
}

// check for level badge
function checkLevelBadge(){
	if (isLoggedIn()){
		$userid_clb = $_SESSION['userid'];
		$user_clb = new profile($userid_clb);
		$user_clb->checkLevelBadge();
	}
}

// check for level badge
function checkMemberBadge(){
	if (isLoggedIn()){
		$userid_cmb = $_SESSION['userid'];
		$user_cmb = new profile($userid_cmb);
		$user_cmb->checkMembershipBadge();
	}
}


function notifchecker(){
	if (isLoggedIn()){
		if ( isset($_SESSION['userid']) ){

			$userid_dnc = $_SESSION['userid'];
			$user_dnc = new profile($userid_dnc);

			$pdo = newPDO();
			$query = $pdo->prepare("SELECT * FROM ".DISMISSNOTIF." WHERE profile_id=:profile_id");
			$query->execute(array(":profile_id"=>$user_dnc->id));
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($results as $r){ 
				?>
				<div class="dismissnotif">
					<span class="dismissicon glyphicon glyphicon-remove-circle"></span>
					<?php echo $r['body']; ?>
				</div>
				<?php 
			}
			$query2 = $pdo->prepare("DELETE FROM ".DISMISSNOTIF." WHERE profile_id=:profile_id");
			$query2->execute(array("profile_id"=>$user_dnc->id));
		}
	}
}


?>