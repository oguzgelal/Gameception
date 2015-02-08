<?php
class questions {

	private $pdo;
	public $found;
	public $id;
	public $match_id = '';
	public $question = '';
	public $correct_answer_id = '';
	public $xp = '';


	public static function LoadAll(){
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHSPECIAL_QUESTIONS." ORDER BY id ASC");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function LoadQuestionsOfMatch( $matchid ){

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHSPECIAL_QUESTIONS." WHERE match_id=:match_id ORDER BY id ASC");
		$query->execute(array(':match_id'=>$matchid));
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}
	public function questions( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_MATCHSPECIAL_QUESTIONS." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->match_id = $r['match_id'];
			$this->question = $r['question'];
			$this->correct_answer_id = $r['correct_answer_id'];
			$this->xp = $r['xp'];
		}
	}
	public function setMatchID($match_id){ $this->match_id = $match_id; }
	public function setQuestion($question){ $this->question = $question; }
	public function setCorrectAnswer($correct_answer_id){ $this->correct_answer_id = $correct_answer_id; }
	public function setXP($xp){ $this->xp = $xp; }

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_MATCHSPECIAL_QUESTIONS." VALUES (
			:id,
			:match_id, 
			:question,
			:correct_answer_id,
			:xp
			)");

		$query->execute(array(
			':id'=>'',
			':match_id'=>$this->match_id, 
			':question'=>$this->question,
			':correct_answer_id'=>$this->correct_answer_id,
			':xp'=>$this->xp
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_MATCHSPECIAL_QUESTIONS." SET 
			`match_id` = :match_id, 
			`question` = :question,
			`correct_answer_id` = :correct_answer_id,
			`xp` = :xp
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':match_id'=>$this->match_id, 
			':question'=>$this->question,
			':correct_answer_id'=>$this->correct_answer_id,
			':xp'=>$this->xp
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_MATCHSPECIAL_QUESTIONS." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}