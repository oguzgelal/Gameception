<?php
class gamers {

	private $pdo;
	public $found;
	public $id;
	public $type; // 1:team 2:person
	public $name;
	public $image;
	public $active;

	public static function LoadAll(){

		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_GAMERS." ORDER BY name");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function gamers( $id = false ){
		$this->pdo = newPDO();
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_GAMERS." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->type = $r['type'];
			$this->name = $r['name'];
			$this->image = $r['image'];
			$this->active = $r['active'];
		}
	}
	public function setType($type){ $this->type = $type; }
	public function setName($name){ $this->name = $name; }
	public function setImage($image){ $this->image = $image; }
	public function setActive($active){ $this->active = $active; }

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_GAMERS." VALUES (
			:id,
			:type, 
			:name, 
			:image, 
			:active
			)");

		$query->execute(array(
			':id'=>'',
			':type'=>$this->type, 
			':name'=>$this->name, 
			':image'=>$this->image, 
			':active'=>$this->active
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_GAMERS." SET 
			`type` = :type, 
			`name` = :name, 
			`image` = :image, 
			`active` = :active 
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':type'=>$this->type, 
			':name'=>$this->name, 
			':image'=>$this->image, 
			':active'=>$this->active
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_GAMERS." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}