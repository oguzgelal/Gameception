<?php
class badges {

	private $pdo;
	public $found;
	public $id;
	public $name;
	public $desc;
	public $image;
	public $xp;

	public static function LoadAll(){
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT id FROM ".TABLE_BADGES);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public function badges( $id = false ){
		$this->pdo = newPDO();;
		if ($id){ $this->Load($id); }
	}
	private function Load( $id ){
		$this->id = $id;
		$query = $this->pdo->prepare("SELECT * FROM ".TABLE_BADGES." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$this->id));
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if (count($results) > 0) { $this->found = 1; }
		else{ $found = 0; }
		foreach($results as $r){
			$this->name = $r['name'];
			$this->desc = $r['desc'];
			$this->image = $r['image'];
			$this->xp = $r['xp'];
		}
	}

	public function setName($name){ $this->name = $name; }
	public function setDesc($desc){ $this->desc = $desc; }
	public function setImage($image){ $this->image = $image; }
	public function setXP($xp){ $this->xp = $xp; }

	public function insert(){
		$query = $this->pdo->prepare("INSERT INTO ".TABLE_BADGES." VALUES (
			:id,
			:name,
			:desc,
			:image,
			:xp
			)");

		$query->execute(array(
			':id'=>'',
			':name'=>$this->name,
			':desc'=>$this->desc,
			':image'=>$this->image,
			':xp'=>$this->xp
			));
		$this->id = $this->pdo->lastInsertId();
		return $this->id;
	}

	public function update(){
		$query = $this->pdo->prepare("UPDATE ".TABLE_BADGES." SET 
			`name` = :name,
			`desc` = :desc,
			`image` = :image, 
			`xp` = :xp 
			WHERE `id` = ".$this->id);

		return $query->execute(array(
			':name'=>$this->name,
			':desc'=>$this->desc,
			':image'=>$this->image, 
			':xp'=>$this->xp
			));
	}

	public function delete(){
		$query = $this->pdo->prepare("DELETE FROM ".TABLE_BADGES." WHERE id=:id");
		$query->execute(array(':id'=>$this->id));
	}

}