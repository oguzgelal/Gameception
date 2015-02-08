<?php
// Simple security check
if ( !isset( $ping ) || $ping != "pong" ) {
	exit();
}
include_once dirname(__FILE__) . "/_htmlstart.php";
include_once dirname(__FILE__) . "/_header.php";
?>

<!-- Contents -->
<section class="container section">
	<div class="row" style="color:white;">

		<?php

		//$usr = new profile(273);
		//$usr->setPass('vDkE4h6h');
		//$usr->update();

		$usr = new profile(1);
		$usr->setMoney(540);
		$usr->update();
		

/*

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT * FROM ".TABLE_PROFILE);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $r){
			$profid = $r['id'];
			$user = new profile($profid);
			$user->giveBadge(CLOSEDBETABADGE);
		$profile = new profile();
		$profile->setName("Atakan");
		$profile->setSurname("Olaş");
		$profile->setNick("atakanolas");
		$profile->setPass("atakanolas");
		$profile->setType(2);
		$profile->setImage("atakan.png");
		$profile->setBio("Atakan Olaş BIO");
		$profile->setLevel(1);
		$profile->setXP(0);
		$profile->setMoney(0);
		$profile->setTotalMoney(0);
		$profile->setMatchesWon(0);
		$profile->setMatchesLost(0);
		$profile->setQuestionsWon(0);
		$profile->setQuestionsLost(0);
		$profile->setKuponWon(0);
		$profile->setKuponLost(0);
		$profile->setRegdate(time());
		$profile->setActive(1);
		$profile->insert();
*/

		?>

	</div>
</section>

<?php
include_once dirname(__FILE__) . "/_footer.php";
include_once dirname(__FILE__) . "/_htmlend.php";
?>



<?php



//$arr = $kupon->getCouponElements();
//foreach($arr as $a){
//	echo $a[0]." ".$a[1]." ".$a[2]."<br>";
//}

//login('user1', 'user1');
//logout();
//if (isLoggedIn()){ echo "loggedin"; }
//else{ echo "nonono"; }
//if (isAdminLoggedIn()){	echo "ADMIN"; }


/*
$answer = new answers(3);
$answer->setQuestionID(1);
$answer->setAnswer("Deneme Answer");
$answer->setCorrect(1);
$answer->setRate(3.2);
$answer->insert();

$question = new questions(3);
$question->setMatchID(15);
$question->setQuestion("Deneme Question 3");
$question->update();

$badge = new badges(4);
$badge->setName("asfas");
$badge->setImage("sfasf");
$badge->setXP(12);
$badge->update();

$profile = new profile(3);
$profile->setName("aaa");
$profile->setSurname("aaaa");
$profile->setNick("aaa");
$profile->setPass("aaa");
$profile->setType(1);
$profile->setImage("aaa.png");
$profile->setBio("aaa");
$profile->setLevel(1);
$profile->setXP(222);
$profile->setMoney(2222222);
$profile->setRegdate(222850908);
$profile->setActive(1);
$profile->update();

$kupon = new kupon(4);
$kupon->setProfileID(1);
$kupon->setSpent(5.8);
$kupon->insert();

$gamer = new games();
$gamer->setName("World Of Tanks");
$gamer->setAbbr("WoT");
$gamer->setActive(1);
$gamer->insert();

$gamer = new gamers();
$gamer->setType(2);
$gamer->setName("Sleeep");
$gamer->setImage("fanatic.png");
$gamer->setActive(1);
$gamer->insert();

$match = new matches();
$match->setGamer1ID(1);
$match->setGamer2ID(2);
$match->setGamer1Rate(4.2);
$match->setGamer2Rate(4.3);
$match->setGameID(4);
$match->setDateD(4);
$match->setDateM(4);
$match->setDateY(4014);
$match->setDateT(4392829572);
$match->setEndT(4392829572);
$match->setDesc("444denemeee");
$match->setXP(44);
$match->setActive(1);
$match->update();
*/
?>