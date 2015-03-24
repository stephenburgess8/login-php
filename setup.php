<?php

function generateStats($id, $state, $name, $type) {

  if ($type === 'knight')
  {
    $hp = 14;
    $maxhp = 15;
    $mp = 0;
    $maxmp = 0;
    $strength = 4;
    $agility = 2;
    $charm = 2;
    $warmth = 2;
    $money = 300;
  } 
  elseif ($type === 'mage') 
  {
    $hp = 9;
    $maxhp = 10;
    $mp = 18;
    $maxmp = 18;
    $strength = 2;
    $agility = 2;
    $charm = 2;
    $warmth = 1;
    $money = 300;
  }
  else
  {
    $hp = 9;
    $maxhp = 10;
    $mp = 5;
    $maxmp = 5;
    $strength = 2;
    $agility = 4;
    $charm = 4;
    $warmth = 1;
    $money = 350;
  }

  echo (string)$state;

  $array = array('id'=>$id, 'state'=>$state, 'actorName'=>$name, 
                'class'=>$type, 'hp'=>$hp, 'maxhp'=>$maxhp,
                'mp'=>$mp, 'maxmp'=>$maxmp, 'strength'=>$strength, 
                'agility'=>$agility, 'charm'=>$charm, 'warmth'=>$warmth,
                'money'=>$money);

  return new Hero ($array);

  /* Hero Object is structured:
    id, state, actorName, class, hp, maxhp, //mp, //maxmp, strength, 
    agility, charm, warmth, money
  */

}

function generateInventory($id, $type) 
{


  

  $potions = new Thing(array('type'=>'health', 'name'=>'Potion', 'persistent'=>FALSE,
                  'offensive'=>FALSE, 'effects'=>array('hp'=>5), 'stackable'=>TRUE,
                  'maxStack'=>5, 'quantity'=>5));

  $hastenSpell = new Thing(array('type'=>'hasten', 'name'=>'Hasten Spell', 'persistent'=>FALSE,
                  'offensive'=>FALSE, 'expiry'=>10, 'effects'=>array('agility'=>2), 'stackable'=>TRUE,
                  'maxStack'=>12, 'quantity'=>1));


  $smallBag = new Container(array('type'=>'bag', 'name'=>'Small Bag', 'slots'=>12));

  $letter = new Readable(array('name'=>'A letter', 'contents'=>"Nephew: We are sad to see you leave
                                but know that you will never be happy with farm life. Here are some
                                basic supplies to get you started on your journeys. Return to us some day
                                in Jenoh Town where you will always be welcome. - Your caring Aunt and Uncle."));

  $roomKey = new Readable(array('name'=>'Room Key', 'contents'=>'Room 103'));

  $smallBag->setStuff(array('i1'=>$letter, 'i2'=>$roomKey));
  $smallBag->setFilledSlots(2);

  $equipment = new Container(array('type'=>'equipment', 'name'=>'Equipment', 'slots'=>'7'));


  if ($type === 'knight')
  {
    $weapon = new Weapon(
              array('kind'=>'sword', 'name'=>'Iron Sword',
                    'damage'=>5, 'effects'=>array('strength'=>2)
                    )
              );

    $speedDraught = array('type'=>'hasten', 'name'=>'Speed Draught', 'persistent'=>FALSE,
                  'offensive'=>FALSE, 'expiry'=>5, 'effects'=>array('agility'=>3),
                  'stackable'=>TRUE, 'maxStack'=>5, 'quantity'=>2);

    $chiaSeeds = array('type'=>'fortify', name=>'Chia Seeds', 'persistent'=>FALSE,
                      'offensive'=>FALSE, 'expiry'=>5, 'effects'=>array('agility'=>1, 'strength'=>1, 'defense'=>1),
                      'stackable'=>TRUE, 'maxStack'=>20, 'quantity'=>4);

    $clothBelt->setStuff(array('i1'=>$potions, 'second'=>$speedDraught, 'third'=>$chiaSeeds, 'four'=>$hastenSpell));

  }
  elseif ($type === 'mage')
  {
    $weapon = new Weapon(
              array('kind'=>'wand', 'name'=>'Cedar Wand',
                    'damage'=>1, 'effects'=>array('mp'=>2, 'maxmp'=>2,
                                                  'charm'=>1)
                    )
              );  

    $delaySpell = array('type'=>'delay', 'name'=>'Delay Spell', 'persistent'=>FALSE,
                  'offensive'=>TRUE, 'expiry'=>10, 'effects'=>array('agility'=>-2),
                  'stackable'=>TRUE, 'maxStack'=>12, 'quantity'=>2);

    $fireball = array('type'=>'fire', 'name'=>'Fireball', 'persistent'=>FALSE,
                  'offensive'=>TRUE, 'expiry'=>-1, 'effects'=>array('hp'=>-3), 'stackable'=>TRUE,
                  'maxStack'=>12, 'quantity'=>3);

    $clothBelt->setStuff(array('i1'=>$potions, 'i2'=>$delaySpell, 'i3'=>$hastenSpell, 'i4'=>$fireball));

  }
  else 
  {
    $weapon = new Weapon(
              array('kind'=>'knife', 'name'=>'Iron Knife',
                    'damage'=>3, 'effects'=>array('hp'=>2, 'maxhp'=>2,
                                            'agility'=>2)
                    )
              );

    $shinyCoin = array('type'=>'charm', 'name'=>'Shiny Coin', 'persistent'=>TRUE,
                  'offensive'=>TRUE, 'expiry'=>3, 'effects'=>array('agility'=>-3), 'stackable'=>FALSE,
                  'maxStack'=>1, 'quantity'=>1);

    $shuriken = array('type'=>'ranged', 'name'=>'Shuriken', 'persistent'=>FALSE,
                  'offensive'=>TRUE, 'expiry'=>-1, 'effects'=>array('hp'=>-3), 'stackable'=>TRUE,
                  'maxStack'=>5, 'quantity'=>3);

    $goldDust = array('type'=>'charm', 'name'=>'Gold Dust', 'persistent'=>FALSE,
                  'offensive'=>FALSE, 'expiry'=>3, 'effects'=>array('agility'=>2, 'hp'=>1, 'charm'=>2),
                  'stackable'=>TRUE, 'maxStack'=>12, 'quantity'=>2);

    $clothBelt->setStuff(array('i1'=>$potions, 'i2'=>$shinyCoin, 'i3'=>$shuriken, 'i4'=>$goldDust));

  }

  $smallBag->setFilledSlots(4);

  $clothShirt = new Equipment(array('type'=>'shirt', 'name'=>'Worn Cloth Shirt',
                'effects'=>array('warmth'=>1, 'defense'=>1)));

  $clothPants = new Equipment(array('type'=>'pants', 'name'=>'Worn Cloth Pants',
                'effects'=>array('warmth'=>1, 'defense'=>1)));

  $wornShoes = new Equipment(array('type'=>'shoes', 'name'=>'Worn Shoes',
                'effects'=>array('agility'=>1)));

  $inventory = array('bag'=>$smallBag);

  return $inventory;

}


function addInfo($sqli) {

    session_start(); 

    $id = $_SESSION['id'];

    $userObject = NULL;

     // FETCH DATA FROM INPUT FIELD
    $userName = mysqli_real_escape_string($sqli, $_POST['heronameInput']);
    $type = mysqli_real_escape_string($sqli, $_POST['class']);

    // Check if all required fields are filled out.
    if (isset($userName, $type))
    {
      // Initializes state
      $userObject = generateStats($id, '00', $userName, $type);
      //echo serialize($userObject);
      $inventory = generateInventory($id, $type);

      // Query from database
      mysqli_query($sqli, "INSERT INTO hero (id, hero) VALUES ('".$id."', '".serialize($userObject)."')");
      mysqli_query($sqli, "INSERT INTO inventory (id, stuff) VALUES ('".$id."', '".serialize($inventory)."')");
      
      $_SESSION['name'] = $id;
      $_SESSION['user'] = serialize($userObject);
      $_SESSION['inventory'] = serialize($inventory);

    }

    else // If $user is not set.
    {
      echo "No bueno name";
    }

  return array('user'=>$userObject, 'inventory'=>$inventory) ;

}

  // MAIN

  require "hero.php";
  require 'sql.php';
  require 'classes.php';

  echo isset($_SESSION['id']);

  $connection = getConnected();

  // Where user state is
  $userInfo = addInfo($connection);

  echo json_encode($userInfo);
  
	exit();

?>