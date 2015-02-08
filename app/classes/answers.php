<?php
class answers {

	private $pdo;
	public $found;
	public $id;
	public $question_id;
	public $answer;
	public $rate;


	public static function LoadAll(){
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHSPECIAL_ANSWERS." ORDER BY id ASC");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function LoadAnswersOfQuestion( $questionid ){

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHSPECIAL_ANSWERS." WHERE question_id=:question_id ORDER BY id ASC");
		$query->execute(array(':question_id'=>$questionid));
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}
	public function answers( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_MATCHSPECIAL_ANSWERS." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->question_id = $r['question_id'];
			$this->answer = $r['answer'];
			$this->rate = $r['rate'];
		}
	}
	public function setQuestionID($question_id){ $this->question_id = $question_id; }
	public function setAnswer($answer){ $this->answer = $answer; }
	public function setRate($rate){ $this->rate = $rate; }

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_MATCHSPECIAL_ANSWERS." VALUES (
			:id,
			:question_id, 
			:answer,
			:rate
			)");

		$query->execute(array(
			':id'=>'',
			':question_id'=>$this->question_id, 
			':answer'=>$this->answer,
			':rate'=>$this->rate
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_MATCHSPECIAL_ANSWERS." SET 
			`question_id` = :question_id, 
			`answer` = :answer,
			`rate` = :rate
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':question_id'=>$this->question_id, 
			':answer'=>$this->answer,
			':rate'=>$this->rate
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_MATCHSPECIAL_ANSWERS." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}