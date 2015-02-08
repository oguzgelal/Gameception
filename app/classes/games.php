<?php
class games {

	private $pdo;
	public $found;
	public $id;
	public $name;
	public $abbr;
	public $active;

	public static function LoadAll(){
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_GAMES);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function LoadListedIn( $page ){

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT game_id FROM ".TABLE_GAMES_LISTED." WHERE page=:page");
		$query->execute(array(':page'=>$page));
		return $query->fetchAll(PDO::FETCH_ASSOC);	

	}
	public function games( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_GAMES." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->name = $r['name'];
			$this->abbr = $r['abbr'];
			$this->active = $r['active'];
		}
	}
	public function setName($name){ $this->name = $name; }
	public function setAbbr($abbr){ $this->abbr = $abbr; }
	public function setActive($active){ $this->active = $active; }

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_GAMES." VALUES (
			:id,
			:name,
			:abbr,
			:active
			)");

		$query->execute(array(
			':id'=>'',
			':name'=>$this->name,
			':abbr'=>$this->abbr,
			':active'=>$this->active
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_GAMES." SET 
			`name` = :name, 
			`abbr` = :abbr, 
			`active` = :active 
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':name'=>$this->name, 
			':abbr'=>$this->abbr, 
			':active'=>$this->active
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_GAMES." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}