<?php
class matches {

	private $pdo;
	public $id;
	public $gamer1_id;
	public $gamer2_id;
	public $gamer1_rate;
	public $gamer2_rate;
	public $game_id;
	public $date_d;
	public $date_m;
	public $date_y;
	public $date_t;
	public $end_t;
	public $desc;
	public $xp;
	public $active;


	public static function LoadAll(){

		try { $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); } 
		catch (PDOException $e) { echo 'Database Error: ' . $e->getMessage(); }
		
		$query = $pdo->prepare("SELECT id FROM ".TABLE_MATCHES);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function matches( $id = false ){

		try { $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); } 
		catch (PDOException $e) { echo 'Database Error: ' . $e->getMessage(); }
		$this->pdo = $pdo;

		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_MATCHES." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $r){
			$this->gamer1_id = $r['gamer1_id'];
			$this->gamer2_id = $r['gamer2_id'];
			$this->gamer1_rate = $r['gamer1_rate'];
			$this->gamer2_rate = $r['gamer2_rate'];
			$this->game_id = $r['game_id'];
			$this->date_d = $r['date_d'];
			$this->date_m = $r['date_m'];
			$this->date_y = $r['date_y'];
			$this->date_t = $r['date_t'];
			$this->end_t = $r['end_t'];
			$this->desc = $r['desc'];
			$this->xp = $r['xp'];
			$this->active = $r['active'];
		}
	}
	public function setGamer1ID($gamer1_id){ $this->gamer1_id = $gamer1_id; }
	public function setGamer2ID($gamer2_id){ $this->gamer2_id = $gamer2_id; }
	public function setGamer1Rate($gamer1_rate){ $this->gamer1_rate = $gamer1_rate; }
	public function setGamer2Rate($gamer2_rate){ $this->gamer2_rate = $gamer2_rate; }
	public function setGameID($game_id){ $this->game_id = $game_id; }
	public function setDateD($date_d){ $this->date_d = $date_d; }
	public function setDateM($date_m){ $this->date_m = $date_m; }
	public function setDateY($date_y){ $this->date_y = $date_y; }
	public function setDateT($date_t){ $this->date_t = $date_t; }
	public function setEndT($end_t){ $this->end_t = $end_t; }
	public function setDesc($desc){ $this->desc = $desc; }
	public function setXP($xp){ $this->xp = $xp; }
	public function setActive($active){ $this->active = $active; }

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_MATCHES." VALUES (
			:id,
			:gamer1_id, 
			:gamer2_id, 
			:gamer1_rate, 
			:gamer2_rate, 
			:game_id, 
			:date_d, 
			:date_m, 
			:date_y, 
			:date_t, 
			:end_t, 
			:desc, 
			:xp, 
			:active
			)");

		$query->execute(array(
			':id'=>'',
			':gamer1_id'=>$this->gamer1_id, 
			':gamer2_id'=>$this->gamer2_id, 
			':gamer1_rate'=>$this->gamer1_rate, 
			':gamer2_rate'=>$this->gamer2_rate, 
			':game_id'=>$this->game_id, 
			':date_d'=>$this->date_d, 
			':date_m'=>$this->date_m, 
			':date_y'=>$this->date_y, 
			':date_t'=>$this->date_t, 
			':end_t'=>$this->end_t, 
			':desc'=>$this->desc, 
			':xp'=>$this->xp, 
			':active'=>$this->active
			));
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_MATCHES." SET 
			`gamer1_id` = :gamer1_id, 
			`gamer2_id` = :gamer2_id, 
			`gamer1_rate` = :gamer1_rate, 
			`gamer2_rate` = :gamer2_rate, 
			`game_id` = :game_id, 
			`date_d` = :date_d, 
			`date_m` = :date_m, 
			`date_y` = :date_y, 
			`date_t` = :date_t, 
			`end_t` = :end_t, 
			`desc` = :desc, 
			`xp` = :xp, 
			`active` = :active 
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':gamer1_id'=>$this->gamer1_id, 
			':gamer2_id'=>$this->gamer2_id, 
			':gamer1_rate'=>$this->gamer1_rate, 
			':gamer2_rate'=>$this->gamer2_rate, 
			':game_id'=>$this->game_id, 
			':date_d'=>$this->date_d, 
			':date_m'=>$this->date_m, 
			':date_y'=>$this->date_y, 
			':date_t'=>$this->date_t, 
			':end_t'=>$this->end_t, 
			':desc'=>$this->desc, 
			':xp'=>$this->xp, 
			':active'=>$this->active
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_MATCHES." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}