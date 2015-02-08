<?php
class profile {

	private $pdo;
	public $found;
	public $id;
	public $name;
	public $surname;
	public $nick;
	public $pass;
	public $type; // 1:user 2:admin
	public $image;
	public $email;
	public $bio;
	public $level;
	public $xp;
	public $money;
	public $total_money;
	public $matches_won;
	public $matches_lost;
	public $questions_won;
	public $questions_lost;
	public $kupon_won;
	public $kupon_lost;
	public $regdate;
	public $active;


	public static function LoadAll(){

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_PROFILE);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function profile( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_PROFILE." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->name = $r['name'];
			$this->surname = $r['surname'];
			$this->nick = $r['nick'];
			$this->pass = $r['pass'];
			$this->type = $r['type'];
			$this->image = $r['image'];
			$this->email = $r['email'];
			$this->bio = $r['bio'];
			$this->level = $r['level'];
			$this->xp = $r['xp'];
			$this->money = $r['money'];
			$this->total_money = $r['total_money'];
			$this->matches_won = $r['matches_won'];
			$this->matches_lost = $r['matches_lost'];
			$this->questions_won = $r['questions_won'];
			$this->questions_lost = $r['questions_lost'];
			$this->kupon_won = $r['kupon_won'];
			$this->kupon_lost = $r['kupon_lost'];
			$this->regdate = $r['regdate'];
			$this->active = $r['active'];
		}
	}
	public function setName($name){ $this->name = $name; }
	public function setSurname($surname){ $this->surname = $surname; }
	public function setNick($nick){ $this->nick = $nick; }
	public function setPass($pass){ $this->pass = sha1($pass); }
	public function setType($type){ $this->type = $type; }
	public function setImage($image){ $this->image = $image; }
	public function setEmail($email){ $this->email = $email; }
	public function setBio($bio){ $this->bio = $bio; }
	public function setLevel($level){ $this->level = $level; }
	public function setXP($xp){ $this->xp = $xp; }
	public function setMoney($money){ $this->money = $money; }
	public function setTotalMoney($total_money){ $this->total_money = $total_money; }
	public function setMatchesWon($matches_won){ $this->matches_won = $matches_won; }
	public function setMatchesLost($matches_lost){ $this->matches_lost = $matches_lost; }
	public function setQuestionsWon($questions_won){ $this->questions_won = $questions_won; }
	public function setQuestionsLost($questions_lost){ $this->questions_lost = $questions_lost; }
	public function setKuponWon($kupon_won){ $this->kupon_won = $kupon_won; }
	public function setKuponLost($kupon_lost){ $this->kupon_lost = $kupon_lost; }
	public function setRegdate($regdate){ $this->regdate = $regdate; }
	public function setActive($active){ $this->active = $active; }

	public function increaseMatchesWon($n=1){ $this->setMatchesWon($this->matches_won+$n); }
	public function increaseMatchesLost($n=1){ $this->setMatchesLost($this->matches_lost+$n); }
	public function increaseQuestionsWon($n=1){ $this->setQuestionsWon($this->questions_won+$n); }
	public function increaseQuestionsLost($n=1){ $this->setQuestionsLost($this->questions_lost+$n); }
	public function increaseKuponWon($n=1){ $this->setKuponWon($this->kupon_won+$n); }
	public function increaseKuponLost($n=1){ $this->setKuponLost($this->kupon_lost+$n); }
	public function getDisplayName(){ return $this->name." '".$this->nick."' ".$this->surname; }


	// return last played coupons that are resulted
	function loadLastResulted($n=5){
		$query_questions = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON." WHERE profile_id = :profile_id AND checked != '0' ORDER BY id DESC LIMIT 0,:n");
		$query_questions->bindValue(':n', (int)$n, PDO::PARAM_INT);
		$query_questions->bindValue(':profile_id', $this->id);
		$query_questions->execute();
		$results = $query_questions->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	// return last played coupons
	function loadLastPlayed($n=5){
		$query_questions = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON." WHERE profile_id = :profile_id ORDER BY id DESC LIMIT 0,:n");
		$query_questions->bindValue(':n', (int)$n, PDO::PARAM_INT);
		$query_questions->bindValue(':profile_id', $this->id);
		$query_questions->execute();
		$results = $query_questions->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	// return unchecked coupons from the obj_coupon table
	function getUncheckedCoupons(){
		$query_questions = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON." WHERE profile_id = :profile_id AND checked = '0'");
		$query_questions->execute(array('profile_id'=>$this->id));
		$results = $query_questions->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	// return unchecked matches from the kupon_matches table
	function getUncheckedMatches(){
		$query_matches = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_MATCHES." WHERE profile_id=:profile_id AND checked='0'");
		$query_matches->execute(array(':profile_id'=>$this->id));
		$results = $query_matches->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	// return unchecked questions from the kupon_questions table
	function getUncheckedQuestions(){
		$query_questions = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_QUESTIONS." WHERE profile_id=:profile_id AND checked='0'");
		$query_questions->execute(array(':profile_id'=>$this->id));
		$results = $query_questions->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	// update the checked property of kupon_matches with the id $kuponmatches_id to $checkedval
	function setMatchChecked($kuponmatches_id , $checkedval){
		$query_matches = $this->pdo->prepare("UPDATE ".TABLE_KUPON_MATCHES." SET checked = :checkedval WHERE id = :id");
		$query_matches->execute(array(':checkedval'=>$checkedval, ':id'=>$kuponmatches_id));
	}
	// update the checked property of kupon_questions with the id $kuponquestions_id to $checkedval
	function setQuestionChecked($kuponquestions_id , $checkedval){
		$query_questions = $this->pdo->prepare("UPDATE ".TABLE_KUPON_QUESTIONS." SET checked = :checkedval WHERE id = :id");
		$query_questions->execute(array(':checkedval'=>$checkedval, ':id'=>$kuponquestions_id));
	}
	// check UNCHECKED coupons (only coupons, not matches or questions) of current user
	function checkCoupons(){
		// retrieve unchecked coupons
		$results = $this->getUncheckedCoupons();
		foreach($results as $r){
			$kupon = new kupon($r['id']);
			// this line changes the 'checked' info of the coupon
			$kuponcheck = $kupon->check();
			// kupon success
			if ($kuponcheck == 1){
				// get total xp of the coupon
				$xpwin = $kupon->getTotalXP();
				// get total rate of the coupon
				$kupontotalrate = $kupon->getTotalRate();
				// calculate how much user wins
				$moneywin = $kupontotalrate*$kupon->spent;
				// add money to users
				$this->setMoney($this->money + $moneywin);
				// add xp to users
				$this->setXP($this->xp + $xpwin);
				// increase coupon won count
				$this->increaseKuponWon();
				// save changes to the db
				$this->update();
				// add notification
				addNotif($this->id, "Tebrikler! Kuponunuz tuttu.");
			}
			else if ($kuponcheck == 2){
				// increase coupon won count
				$this->increaseKuponLost();
				// save changes to the db
				$this->update();
				// add notification
				addNotif($this->id, "Kuponunuz yattı.");
			}
		}
	}
	// check UNCHECKED matches of user (nothing related to coupons)
	function checkMatches(){
		$results = $this->getUncheckedMatches();
		foreach($results as $r){
			$kuponmatch_id = $r['id'];
			$matchid = $r['match_id'];
			$choiceid = $r['choice_gamer_id'];
			$match = new matches($matchid);
			$winnerid = $match->winner_gamer_id;

			if ($winnerid != 0){	
				// match won
				if ($winnerid == $choiceid){ 
					$this->setMatchChecked($kuponmatch_id, 1);
					$this->increaseMatchesWon();
				}
				// match lost
				else{
					$this->setMatchChecked($kuponmatch_id, 2);
					$this->increaseMatchesLost();
				}
			}

		}
		$this->update();
	}
	// check UNCHECKED questions of user (nothing related to coupons)
	function checkQuestions(){
		$results = $this->getUncheckedQuestions();
		foreach($results as $r){
			$kuponquestion_id = $r['id'];
			$questionid = $r['question_id'];
			$answered = $r['answer_id'];
			$question = new questions($questionid);
			$correctanswer = $question->correct_answer_id;

			if ($correctanswer != 0){	
				// question won
				if ($correctanswer == $answered){ 
					$this->setQuestionChecked($kuponquestion_id, 1);
					$this->increaseQuestionsWon();
				}
				// match lost
				else{
					$this->setQuestionChecked($kuponquestion_id, 2);
					$this->increaseQuestionsLost();
				}
			}
			
		}
		$this->update();
	}

	// transfer monthly money to total money
	function transferMonthlyToTotal() {
		$money_after_reset = DEFAULTMONEY;
		$this->total_money += $this->money;
		$this->money = $money_after_reset;
		$this->update();
		addNotif($this->id, "Dikkat! Aylık krediniz toplam kredinize aktarıldı.");
	}

	// BADGES

	// return 0 if user has the badge
	function hasBadge($badgeid){
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_BADGES_PROFILE." WHERE badge_id=:badge_id AND profile_id=:profile_id");
		$query->execute(array(':badge_id'=>$badgeid,':profile_id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		$count = count($results);
		return ($count > 0);
	}
	// give the badge to user
	function giveBadge($badgeid){
		if (!$this->hasBadge($badgeid)){
			$query = $this->pdo->prepare("INSERT INTO ".TABLE_BADGES_PROFILE." VALUES (:id, :badge_id, :profile_id)");
			$query->execute(array(':id'=>'',':badge_id'=>$badgeid,':profile_id'=>$this->id));
			$badge = new badges($badgeid);
			$badgexp = $badge->xp;
			$this->setXP($this->xp + $badgexp);
			$this->update();
			addNotif($this->id, "Yeni badge !!! ".$badge->name." badge ini kazandınız...");
		}
	}

	// check if user earns a level badge
	public function checkLevelBadge(){
		$level1_limit = 2;
		$level2_limit = 5;
		$level3_limit = 10;
		$level4_limit = 20;
		$level5_limit = 50;
		if ($this->level >= $level1_limit && !($this->hasBadge(LEVELBADGE1)) ){ $this->giveBadge(LEVELBADGE1); }
		if ($this->level >= $level2_limit && !($this->hasBadge(LEVELBADGE2)) ){	$this->giveBadge(LEVELBADGE2); }
		if ($this->level >= $level3_limit && !($this->hasBadge(LEVELBADGE3)) ){	$this->giveBadge(LEVELBADGE3); }
		if ($this->level >= $level4_limit && !($this->hasBadge(LEVELBADGE4)) ){	$this->giveBadge(LEVELBADGE4); }
		if ($this->level >= $level5_limit && !($this->hasBadge(LEVELBADGE5)) ){	$this->giveBadge(LEVELBADGE5); }
	}

	// check if user earns a member badge
	public function checkMembershipBadge(){
		$level1_limit = 2628000; // 1 month
		$level2_limit = 7884000; // 3 monts
		$level3_limit = 15770000; // 6 month
		$level4_limit = 31540000; // 1 year
		$level5_limit = 94610000; // 3 years
		$diff = time() - $this->regdate;
		if ($diff >= $level1_limit && !($this->hasBadge(MEMBERBADGE1)) ){ $this->giveBadge(MEMBERBADGE1); }
		if ($diff >= $level2_limit && !($this->hasBadge(MEMBERBADGE2)) ){ $this->giveBadge(MEMBERBADGE2); }
		if ($diff >= $level3_limit && !($this->hasBadge(MEMBERBADGE3)) ){ $this->giveBadge(MEMBERBADGE3); }
		if ($diff >= $level4_limit && !($this->hasBadge(MEMBERBADGE4)) ){ $this->giveBadge(MEMBERBADGE4); }
		if ($diff >= $level5_limit && !($this->hasBadge(MEMBERBADGE5)) ){ $this->giveBadge(MEMBERBADGE5); }
	}

	// get badges of the user
	public function getBadges(){
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_BADGES_PROFILE." WHERE profile_id = :profile_id");
		$query->execute(array(':profile_id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_PROFILE." VALUES (
			:id,
			:name, 
			:surname, 
			:nick, 
			:pass, 
			:type, 
			:image,
			:email,
			:bio, 
			:level, 
			:xp, 
			:money,
			:total_money,
			:matches_won,
			:matches_lost,
			:questions_won,
			:questions_lost,
			:kupon_won,
			:kupon_lost,
			:regdate, 
			:active
			)");

		$query->execute(array(
			':id'=>'',
			':name'=>$this->name, 
			':surname'=>$this->surname, 
			':nick'=>$this->nick, 
			':pass'=>$this->pass, 
			':type'=>$this->type, 
			':image'=>$this->image, 
			':email'=>$this->email, 
			':bio'=>$this->bio, 
			':level'=>$this->level, 
			':xp'=>$this->xp, 
			':money'=>$this->money,
			':total_money'=>$this->total_money, 
			':matches_won'=>$this->matches_won,
			':matches_lost'=>$this->matches_lost,
			':questions_won'=>$this->questions_won,
			':questions_lost'=>$this->questions_lost,
			':kupon_won'=>$this->kupon_won,
			':kupon_lost'=>$this->kupon_lost,
			':regdate'=>$this->regdate, 
			':active'=>$this->active
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_PROFILE." SET 
			`name` = :name, 
			`surname` = :surname, 
			`nick` = :nick, 
			`pass` = :pass, 
			`type` = :type, 
			`image` = :image, 
			`email` = :email, 
			`bio` = :bio, 
			`level` = :level, 
			`xp` = :xp, 
			`money` = :money,
			`total_money` = :total_money, 
			`matches_won` = :matches_won,
			`matches_lost` = :matches_lost,
			`questions_won` = :questions_won,
			`questions_lost` = :questions_lost,
			`kupon_won` = :kupon_won,
			`kupon_lost` = :kupon_lost,
			`regdate` = :regdate, 
			`active` = :active 
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':name'=>$this->name, 
			':surname'=>$this->surname, 
			':nick'=>$this->nick, 
			':pass'=>$this->pass, 
			':type'=>$this->type, 
			':image'=>$this->image, 
			':email'=>$this->email, 
			':bio'=>$this->bio, 
			':level'=>$this->level, 
			':xp'=>$this->xp, 
			':money'=>$this->money,
			':total_money'=>$this->total_money,
			':matches_won'=>$this->matches_won,
			':matches_lost'=>$this->matches_lost,
			':questions_won'=>$this->questions_won,
			':questions_lost'=>$this->questions_lost,
			':kupon_won'=>$this->kupon_won,
			':kupon_lost'=>$this->kupon_lost,
			':regdate'=>$this->regdate, 
			':active'=>$this->active
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_PROFILE." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}