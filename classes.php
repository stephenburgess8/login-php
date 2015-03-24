<?php 


// Objects that contain other objects
// such as belts and bags.

class Container
{
	public $type;
	public $name;
	public $slots;
	public $filledSlots;
	public $stuff;

	public function __construct($array)  
    {  
    	$this->type = $array['type'];
    	$this->name = $array['name'];
    	$this->slots = $array['slots'];
    	$this->filledSlots = 0;
    	$this->stuff = array();
    }

    // Getters and Setters

    public function getType() {
    	return $this->type;
    }

    public function setType($value) {
    	$this->type = $value;
    }

    public function getName() {
    	return $this->name;
    }

    public function setName($value) {
    	$this->name = $value;
    }

    public function getSlots() {
    	return $this->slots;
    }

    public function setSlots($value) {
    	$this->slots = $value;
    }

    public function getFilledSlots() {
    	return $this->filledSlots;
    }

    public function setFilledSlots($value) {
    	$this->filledSlots = $value;
    }

    public function getStuff() {
    	return $this->stuff;
    }

    public function setStuff($value) {
    	$this->stuff = $value;
    }

    public function addOne() {
    	$this->filledSlots = $this->filledSlots + 1;
    }

    public function removeOne() {
    	$this->filledSlots = $this->filledSlots - 1;
    }

}


// Objects that can be used
// such as potions and spells

class Thing
{
	public $type;
	public $name;

	public $persistent;
	public $expiry;

	public $offensive;
	public $effects; // array

	public $stackable;
	public $maxStack;
	public $quantity;

	public function __construct($array)  
	{
		$this->type = $array['type'];
		$this->name = $array['name'];
		$this->persistent = $array['persistent'];
		$this->expiry = $array['expiry'];
		$this->offensive = $array['offensive'];
		$this->effects = $array['effects'];
		$this->stackable = $array['stackable'];
		$this->maxStack = $array['maxStack'];
		$this->quantity = $array['quantity'];
	} 

}

class Equipment
{
	public $type;
	public $name;

	public $effects; // array
	public $worth;

	public function __construct($array)  
	{
		$this->type = $array['type'];
		$this->name = $array['name'];
		$this->effects = $array['effects'];
		$this->worth = $array['worth'];
	} 

	public function getType() {
		return $this->type;
	}

	public function setType($value) {
		$this->type = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

	public function getEffects() {
		return $this->effects;
	}

	public function setEffects($value) {
		$this->effects = $value;
	}
}

class Weapon
{
	public $kind;
	public $wName;

	public $damage;
	public $effects;

	public $worth;

	public function __construct($array)  
	{
		$this->kind = $array['kind'];
		$this->wName = $array['name'];
		$this->damage = $array['damage'];
		$this->effects = $array['effects'];
		$this->worth = $array['worth'];
	} 

	public function getKind() {
		return $this->kind;
	}

	public function setKind($value) {
		$this->kind = $value;
	}

	public function getWName() {
		return $this->wName;
	}

	public function setWName($value) {
		$this->wName = $value;
	}

	public function getDamage() {
		return $this->damage;
	}

	public function setDamage($value) {
		$this->damage = $value;
	}

	public function getEffects() {
		return $this->effects;
	}

	public function setEffects($value) {
		$this->effects = $value;
	}

	public function getWorth() {
		return $this->worth;
	}

	public function setWorth($value) {
		$this->worth = $value;
	}
}

class Readable
{
	public $rName;

	public $contents;


	public function __construct($array)  
	{
		$this->rName = $array['name'];
		$this->contents = $array['contents'];
	} 

	public function getRName() {
		return $this->rName;
	}

	public function setRName($value) {
		$this->rName = $value;
	}

	public function getContents() {
		return $this->contents;
	}

	public function setContents($value) {
		$this->contents = $value;
	}
}

class NPC 
{
	public $npcName;
	public $hostile;

	public $hp;
	public $maphp;
	public $mp;
	public $maxmp;

	public $strength;
	public $agility;

	public $drop;

	public function __construct($array)  
	{ 
		$this->npcName = $array['name'];
		$this->hostile = $array['hostile'];
		$this->hp = $array['hp'];
		$this->maxhp = $array['maxhp'];
		$this->mp = $array['mp'];
		$this->maxmp = $array['maxmp'];
		$this->strength = $array['strength'];
		$this->agility = $array['agility'];
		$this->drop = $array['drop'];
	}

	public function getNPCName() {
		return $this->npcName;
	}

	public function setNPCName($value) {
		$this->npcName = $value;
	}

	public function getHostile() {
		return $this->hostile;
	}

	public function setHostile($value) {
		$this->hostile = $value;
	}

	public function getHP() {
		return $this->hp;
	}

	public function setHP($value) {
		$this->hp = $value;
	}

	public function getMaxHP() {
		return $this->maxhp;
	}

	public function setMaxHP($value) {
		$this->maxhp = $value;
	}

	public function getMP() {
		return $this->mp;
	}

	public function setMP($value) {
		$this->mp = $value;
	}

	public function getMaxMP() {
		return $this->maxmp;
	}

	public function setMaxMP($value) {
		$this->maxmp = $value;
	}

	public function getStrength() {
		return $this->strength;
	}

	public function setStrength($value) {
		$this->strength = $value;
	}

	public function getAgility() {
		return $this->agility;
	}

	public function setAgility($value) {
		$this->agility = $value;
	}

	public function getDrop() {
		return $this->drop;
	}

	public function setDrop($value) {
		$this->drop = $value;
	}
}
 ?>