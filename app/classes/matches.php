<?php
class matches {

	private $pdo;
	public $found;
	public $id;
	public $gamer1_id;
	public $gamer2_id;
	public $gamer1_rate;
	public $gamer2_rate;
	public $game_id;
	public $stream;
	public $date_t;
	public $end_t;
	public $desc;
	public $xp;
	public $active;
	public $winner_gamer_id;


	public static function LoadAll(){

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHES." ORDER BY date_t ASC");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function LoadMatchesOfGame( $gameid , $limit=0){

		$pdo = newPDO();
		$limitsql="";
		if ($limit != 0){
			$limitsql = "LIMIT 0, ".sanitize_string($limit);
		}
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHES." WHERE game_id=:game_id AND date_t>:datetime ORDER BY date_t ASC ".$limitsql);
		$query->execute(array(':game_id'=>$gameid, ':datetime'=>time()));
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}

	public static function LoadUpcomingMatches( $gameid ){

		$pdo = newPDO();
		$time = time();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHES." WHERE date_t>=".$time." ORDER BY date_t ASC");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}

	public function matches( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_MATCHES." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->gamer1_id = $r['gamer1_id'];
			$this->gamer2_id = $r['gamer2_id'];
			$this->gamer1_rate = $r['gamer1_rate'];
			$this->gamer2_rate = $r['gamer2_rate'];
			$this->game_id = $r['game_id'];
			$this->stream = $r['stream'];
			$this->date_t = $r['date_t'];
			$this->end_t = $r['end_t'];
			$this->desc = $r['desc'];
			$this->xp = $r['xp'];
			$this->active = $r['active'];
			$this->winner_gamer_id = $r['winner_gamer_id'];
		}
	}
	public function setGamer1ID($gamer1_id){ $this->gamer1_id = $gamer1_id; }
	public function setGamer2ID($gamer2_id){ $this->gamer2_id = $gamer2_id; }
	public function setGamer1Rate($gamer1_rate){ $this->gamer1_rate = $gamer1_rate; }
	public function setGamer2Rate($gamer2_rate){ $this->gamer2_rate = $gamer2_rate; }
	public function setGameID($game_id){ $this->game_id = $game_id; }
	public function setStream($stream){ $this->stream = $stream; }
	public function setDateT($date_t){ $this->date_t = $date_t; }
	public function setEndT($end_t){ $this->end_t = $end_t; }
	public function setDesc($desc){ $this->desc = $desc; }
	public function setXP($xp){ $this->xp = $xp; }
	public function setActive($active){ $this->active = $active; }
	public function setWinnerID($winner_gamer_id){ $this->winner_gamer_id = $winner_gamer_id; }

	public function notPassed() {
		$nowtime = time();
		return ($this->end_t > $nowtime);
	}

	public function matchInfo(){
		$gamer1 = new gamers($this->gamer1_id);
		$gamer2 = new gamers($this->gamer2_id);
		$game = new games($this->game_id);
		return "(".$game->abbr.") ".$gamer1->name." vs ".$gamer2->name." - ".simpleDate($this->date_t);
	}

	public function questionNum(){
		$questions = questions::LoadQuestionsOfMatch($this->id);
		return count($questions);
	}

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_MATCHES." VALUES (
			:id,
			:gamer1_id, 
			:gamer2_id, 
			:gamer1_rate, 
			:gamer2_rate, 
			:game_id,
			:stream,
			:date_t, 
			:end_t, 
			:desc, 
			:xp, 
			:active,
			:winner_gamer_id
			)");

		$query->execute(array(
			':id'=>'',
			':gamer1_id'=>$this->gamer1_id, 
			':gamer2_id'=>$this->gamer2_id, 
			':gamer1_rate'=>$this->gamer1_rate, 
			':gamer2_rate'=>$this->gamer2_rate, 
			':game_id'=>$this->game_id,
			':stream'=>$this->stream,
			':date_t'=>$this->date_t, 
			':end_t'=>$this->end_t, 
			':desc'=>$this->desc, 
			':xp'=>$this->xp, 
			':active'=>$this->active,
			':winner_gamer_id'=>$this->winner_gamer_id
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_MATCHES." SET 
			`gamer1_id` = :gamer1_id, 
			`gamer2_id` = :gamer2_id, 
			`gamer1_rate` = :gamer1_rate, 
			`gamer2_rate` = :gamer2_rate, 
			`game_id` = :game_id,
			`stream` = :stream,
			`date_t` = :date_t, 
			`end_t` = :end_t, 
			`desc` = :desc, 
			`xp` = :xp, 
			`active` = :active,
			`winner_gamer_id` = :winner_gamer_id
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':gamer1_id'=>$this->gamer1_id, 
			':gamer2_id'=>$this->gamer2_id, 
			':gamer1_rate'=>$this->gamer1_rate, 
			':gamer2_rate'=>$this->gamer2_rate, 
			':game_id'=>$this->game_id,
			':stream'=>$this->stream,
			':date_t'=>$this->date_t, 
			':end_t'=>$this->end_t, 
			':desc'=>$this->desc, 
			':xp'=>$this->xp, 
			':active'=>$this->active,
			':winner_gamer_id'=>$this->winner_gamer_id
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_MATCHES." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}