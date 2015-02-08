<?php
class kupon {

	private $pdo;
	public $found;
	public $id;
	public $profile_id;
	public $spent;
	public $checked;
	public $date;

	public static function LoadAll(){
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_KUPON);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function kupon( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
		else{ $this->checked = 0; }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->profile_id = $r['profile_id'];
			$this->spent = $r['spent'];
			$this->checked = $r['checked'];
			$this->date = $r['date'];
		}
	}
	public function setProfileID($profile_id){ $this->profile_id = $profile_id; }
	public function setSpent($spent){ $this->spent = $spent; }
	public function setChecked($checked){ $this->checked = $checked; }
	
	// Get all the matches in this coupon
	function getPlayedMatches(){
		$query_matches = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_MATCHES." WHERE kupon_id=:kupon_id");
		$query_matches->execute(array(':kupon_id'=>$this->id));
		$results = $query_matches->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
	// Get all the questions in this coupon
	function getPlayedQuestions(){
		$query_questions = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_QUESTIONS." WHERE kupon_id=:kupon_id");
		$query_questions->execute(array(':kupon_id'=>$this->id));
		$results = $query_questions->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	// calculate the total xp of this coupon
	function getTotalXP(){
		$totalxp = 0;
		$matches = $this->getPlayedMatches();
		$questions = $this->getPlayedQuestions();
		foreach($matches as $m){ 
			$match = new matches($m['match_id']);
			if ($match->found){ $totalxp += $match->xp; }
		}
		foreach($questions as $q){
			$question = new questions($q['question_id']);
			if ($question->found==1){ $totalxp += $question->xp; }
		}
		return $totalxp;
	}
	
	// calculate the total rate of this coupon
	function getTotalRate(){
		$totalrate = 1;
		$matches = $this->getPlayedMatches();
		$questions = $this->getPlayedQuestions();
		foreach($matches as $m){ 
			$match = new matches($m['match_id']);
			if ($match->found==1){
				$selection = $m['choice_gamer_id'];
				if ($selection == 1){ $totalrate *= $match->gamer1_rate; }
				else if ($selection == 2){ $totalrate *= $match->gamer2_rate; }
			}
		}
		foreach($questions as $q){
			$answered = $q['answer_id'];
			$answer = new answers($answered);
			if ($answer->found==1){
				$totalrate *= $answer->rate;
			}
		}
		return $totalrate;
	}

	// only checks for coupons (to increase coupon count and to mark coupon as won or lost)
	function checkMatches(){
		$results = $this->getPlayedMatches();
		if (count($results) == 0){ return -1; }
		$kuponlost = 0;
		$pending = 0;
		foreach($results as $r) {
			$matchid = $r['match_id'];
			$selectionid = $r['choice_gamer_id'];
			$match = new matches($matchid);
			if ($match->found==1){
				// if match result not entered
				if ($match->winner_gamer_id == 0){ 
					$pending = 1;
				}
				// match lost
				else if ($match->winner_gamer_id != $selectionid){ return 2; }
			}
		}
		// coupon success
		if ($pending == 0){ return 1; }
		// coupon pending
		else{ return 0; }
	}
	// only checks for coupons (to increase coupon count and to mark coupon as won or lost)
	function checkQuestions(){
		$results = $this->getPlayedQuestions();
		if (count($results) == 0){ return -1; }
		$pending = 0;
		foreach($results as $r){
			$questionid = $r['question_id'];
			$answerid = $r['answer_id'];
			$question = new questions($questionid);
			$correct_answer_id = $question->correct_answer_id;
			// if question result not entered
			if ($correct_answer_id == 0){
				$pending = 1;
			}
			// question lost
			else if ($correct_answer_id != $answerid){ return 2; }
		}
		// coupon success
		if ($pending == 0){	return 1; }
		// coupon pending
		else{ return 0; }
	}

	public function check(){
		$cm = $this->checkMatches();
		$cq = $this->checkQuestions();
		//echo $this->id." / ".$cm." / ".$cq."<br>";
		// matches or questions fail -> coupon fails
		if ($cm==2 || $cq==2){ 
			$this->setChecked(2);
			$this->update();
			return 2;
		}
		// matches or questions are in pending -> coupon is pending
		else if ($cm==0 || $cq==0) {
			$this->setChecked(0);
			$this->update();
			return 0;
		}
		// no match on coupon -> state of questions determine state of coupon
		else if ($cm==-1){
			$this->setChecked($cq);
			$this->update();
			return $cq;
		}
		// no question on coupon -> state of matches determine state of coupon
		else if ($cq==-1){
			$this->setChecked($cm);
			$this->update();
			return $cm;
		}
		// coupon contains both questions and matches, none of them are fail or in pending -> coupon success
		else {
			$this->setChecked(1);
			$this->update();
			return 1;
		}
	}

	public function addMatch($matchid, $played) {
		$matchid = sanitize_string($matchid);
		$match = new matches($matchid);
		$played = sanitize_string($played);
		if ($match->found && $this->id){
			$query = $this->pdo->prepare("INSERT INTO ".TABLE_KUPON_MATCHES." VALUES (:id, :kupon_id, :match_id, :choice_gamer_id, :profile_id, :checked)");
			$exec = $query->execute(array(
				':id'=>'',
				':kupon_id'=>$this->id,
				':match_id'=>$match->id,
				':choice_gamer_id'=>$played,
				':profile_id'=>$this->profile_id,
				':checked'=>0
				));
			return $exec;
		}
		return 0;
	}
	public function addQuestion($questionid, $answerid) {
		$questionid = sanitize_string($questionid);
		$answerid = sanitize_string($answerid);
		$question = new questions($questionid);
		$answer = new answers($answerid);
		if ($question->found && $answer->found && $this->id){
			$query = $this->pdo->prepare("INSERT INTO ".TABLE_KUPON_QUESTIONS." VALUES (:id, :kupon_id, :question_id, :answer_id, :profile_id, :checked)");
			$exec = $query->execute(array(
				':id'=>'',
				':kupon_id'=>$this->id,
				':question_id'=>$question->id,
				':answer_id'=>$answer->id,
				':profile_id'=>$this->profile_id,
				':checked'=>0
				));
			return $exec;	
		}
		return 0;
	}

	public function getCouponElements(){
		$played = array();
		$included_questions = array();
		$query_match = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_MATCHES." WHERE kupon_id=:kupon_id ORDER BY id ASC");
		$query_match->execute(array("kupon_id"=>$this->id));
		$matches = $query_match->fetchAll(PDO::FETCH_ASSOC);
		foreach($matches as $m){
			$push2array = array(0, $m['match_id'], $m['choice_gamer_id']);
			array_push($played, $push2array);
			$query_question = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_QUESTIONS." WHERE kupon_id=:kupon_id ORDER BY id ASC");
			$query_question->execute(array("kupon_id"=>$this->id));
			$questions = $query_question->fetchAll(PDO::FETCH_ASSOC);
			foreach($questions as $q){
				$question = new questions($q['question_id']);
				if ($question->match_id == $m['match_id']){
					$push2array = array(1, $q['question_id'], $q['answer_id']);
					array_push($played, $push2array);
					array_push($included_questions, $q['question_id']);
				}
			}
		}
		$query_question_2 = $this->pdo->prepare("SELECT * FROM ".TABLE_KUPON_QUESTIONS." WHERE kupon_id=:kupon_id ORDER BY id ASC");
		$query_question_2->execute(array("kupon_id"=>$this->id));
		$questions_2 = $query_question_2->fetchAll(PDO::FETCH_ASSOC);
		foreach($questions_2 as $q){
			if (!in_array($q['question_id'], $included_questions)){
				$push2array = array(1, $q['question_id'], $q['answer_id']);
				array_push($played, $push2array);
			}
		}
		return $played;
	}

	public function getCouponHTML(){

		$totalrate = 1;
		$earning = 0;
		$html = "";
		//$kuponicon = "";
		//$kuponicon_final = "";

		$elements = $this->getCouponElements();
		foreach($elements as $elm){
			if ($elm && is_array($elm)){

				if ($elm[0] == 0){
					$matchid = $elm[1];
					$match = new matches($matchid);

					if ($match->found == 1){

						$game = new games($match->game_id);
						$gameabbr = $game->abbr;

						$gamer1 = new gamers($match->gamer1_id);
						$gamer2 = new gamers($match->gamer2_id);
						$gamer1name = $gamer1->name;
						$gamer2name = $gamer2->name;

						$selected = $elm[2];
						$gamer1class = ($selected == 1) ? "selected" : "";
						$gamer2class = ($selected == 2) ? "selected" : "";

						$rate = ($selected == 1) ? $match->gamer1_rate : $match->gamer2_rate;
						$totalrate *= $rate;
						$rate = round($rate, 2);

						if ($match->winner_gamer_id == 0){ 
							//$kuponicon = "<span class='glyphicon glyphicon-time pending'></span>";
							$icon = "<span class='glyphicon glyphicon-time pending'></span>";
						}
						else{
							if ($match->winner_gamer_id == $selected){
								$icon = "<span class='glyphicon glyphicon-ok pass'></span>";
							}
							else{
								//$kuponicon_final = "<span class='glyphicon glyphicon-remove fail'></span>";
								$icon = "<span class='glyphicon glyphicon-remove fail'></span>";
							}
						}

						$html .= "
						<li class='simplelist_element' id='kupon'>
						<a href='/index.php?a=stream&b=".$matchid."'>
						<div class='gamename'><div class='gamenametext'>".$gameabbr."</div></div>
						<div class='kuponmatchgamers'>
						<div class='kupongamer kupongamer1 ".$gamer1class."'>".$gamer1name."</div>
						<div class='vs'>vs</div>
						<div class='kupongamer kupongamer2 ".$gamer2class."'>".$gamer2name."</div>
						</div>
						<div class='kuponmatchrate'>
						<div class='ratetext'>Oran </div>
						<div class='rate'>".$rate."</div>
						</div>
						<div class='kuponmatchstate'>".$icon."</div>
						<div class='clearfix'></div>
						</a>
						</li>
						";
					}
				}

				else if ($elm[0] == 1) {
					$question = new questions($elm[1]);
					$answer = new answers($elm[2]);

					if ($question->found==1 && $answer->found==1){

						$matchid = $question->match_id;

						$questionText = $question->question;
						$answerText = $answer->answer;

						$rate = $answer->rate;
						$totalrate *= $rate;
						$rate = round($rate, 2);

						if ($question->correct_answer_id == 0){ 
							//$kuponicon = "<span class='glyphicon glyphicon-time pending'></span>";
							$icon = "<span class='glyphicon glyphicon-time pending'></span>";
						}
						else{
							if ($question->correct_answer_id == $answer->id){
								$icon = "<span class='glyphicon glyphicon-ok pass'></span>";
							}
							else{
								//$kuponicon_final = "<span class='glyphicon glyphicon-remove fail'></span>";
								$icon = "<span class='glyphicon glyphicon-remove fail'></span>";
							}
						}

						$html .= "
						<li class='simplelist_element' id='kupon'>
						<a href='/index.php?a=stream&b=".$matchid."'>
						<div class='gamename'><div class='questionicon'> <span class='glyphicon glyphicon-star'></span> </div></div>
						<div class='kuponquestions'>
						<div class='questionText'>".$questionText."</div>
						<div class='questionAnswer'>".$answerText."</div>
						<div class='clearfix'></div>
						</div>
						<div class='kuponmatchrate'>
						<div class='ratetext'>Oran</div>
						<div class='rate'>".$rate."</div>
						</div>
						<div class='kuponmatchstate'>".$icon."</div>
						<div class='clearfix'></div>
						</a>
						</li>
						";

					}
				}
			}
		}

		/*
		if ($kuponicon_final == ""){
			if ($kuponicon == ""){ $kuponicon = "<span class='glyphicon glyphicon-ok pass'></span>"; }
		}
		else{
			$kuponicon = $kuponicon_final;
		}
		*/
		
		if ($this->checked == 0){ $kuponicon = "<span class='glyphicon glyphicon-time pending'></span>"; }
		else if ($this->checked == 1){ $kuponicon = "<span class='glyphicon glyphicon-ok pass'></span>"; }
		else if ($this->checked == 2){ $kuponicon = "<span class='glyphicon glyphicon-remove fail'></span>"; }
		else { $kuponicon = ""; }


		$html_start =  "
		<div class='kuponholder'>
		<div class='simplelist' id='kuponprint'>
		<div class='simplelist_tabs'>
		<div class='simplelist_tab active'>
		<div class='simplelist_title'>Kupon ".$kuponicon."</div>
		</div>
		<div class='clearfix'></div>
		</div>
		<div class='simplelist_content'>
		<ul class='list-unstyled simplelist_ul selectedmatches'>
		";

		$deposit = $this->spent;
		$earning = $deposit * $totalrate;
		$totalrate = round($totalrate, 2);
		$deposit = round($deposit, 2);
		$earning = round($earning, 2);

		$year = getYear($this->date);
		$month = getMonth($this->date);
		$day = getDay($this->date);
		$hour = getHour($this->date);
		$min = getMinute($this->date);

		$html_end = "
		</ul>
		<div class='totalbar'>
		<div class='totalbar_column' id='left'>
		<div class='totalbar_element totalbar_rate'>
		<div class='totalbar_element_child totalbar_rate_txt'>Oran</div>
		<div class='totalbar_element_child totalbar_rate_rate'>: <span class='ratetxt'>".$totalrate."</span></div>
		<div class='clearfix'></div>
		</div>
		<div class='totalbar_element totalbar_money'>
		<div class='totalbar_element_child totalbar_money_txt'>Yatırım</div>
		<div class='totalbar_element_child totalbar_money_money'>: <input disabled value='".$deposit."' type='text' name='totalbar_money_input' id='totalbar_money_input' class='totalbar_money_input'></div>
		<div class='clearfix'></div>
		</div>
		<div class='totalbar_element totalbar_earning'>
		<div class='totalbar_element_child totalbar_earning_txt'>Kazanç</div>
		<div class='totalbar_element_child totalbar_earning_earning'>: <span class='earningtxt'>".$earning."</span></div>
		<div class='clearfix'></div>
		</div>
		</div>
		<div class='totalbar_column' id='right'>
		<input type='button' class='btn btn-xs btn-default totalbar_button' id='downloadcoupon' value='İndir'>
		<div class='coupondate'>".$hour.":".$min."<br>".$day."/".$month."/".$year."</div>
		</div>
		<div class='clearfix'></div>
		</div>
		</div>
		</div>
		</div>
		";

		return $html_start.$html.$html_end;

	}

	public function insert(){
		$date = time();
		$this->date = $date;
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_KUPON." VALUES (
			:id,
			:profile_id, 
			:spent,
			:checked,
			:date
			)");

		$query->execute(array(
			':id'=>'',
			':profile_id'=>$this->profile_id, 
			':spent'=>$this->spent,
			':checked'=>$this->checked,
			':date'=>$this->date
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_KUPON." SET 
			`id` = :id, 
			`profile_id` = :profile_id, 
			`spent` = :spent,
			`checked` = :checked,
			`date` = :date
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':id'=>$this->id, 
			':profile_id'=>$this->profile_id, 
			':spent'=>$this->spent,
			':checked'=>$this->checked,
			':date'=>$this->date
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_KUPON." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}