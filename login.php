<?php 

function validateUser($sqli)
{
  $error = '';
  $id = 0;


   // Fetch data
  $user = mysqli_real_escape_string($sqli, $_POST['usernameInput']);


  // Two-fold password encryption hashing algorithm (hashing, hashed salt)
  $tempPass = mysqli_real_escape_string($sqli, $_POST['passwordInput']);
  $salt = '1k7R!@bRUS}DW%Zy-tj{.o70WVm'.$user.'FbjRQ#s+[@-~,!SaJ[`%51^$E{zZ>S}=?`Gq';
  $pass = md5($tempPass.$salt);
  $pass = sha1($pass);

  // Check that required fields from form are filled
 if (isset($user, $tempPass))
 {

    // QUERY FROM DATABASE
    $query = mysqli_query($sqli, "SELECT * FROM users WHERE handle = '".$user."' LIMIT 1");
    $checkuser = mysqli_num_rows($query);


     // Check if username is matched with existing row
    if($checkuser < 1)
    {  
      $error = "Username doesn't exist in our database!";
      $id = -1;
    }


     // Fetching user password hash in database for comparison.
    while ($row = mysqli_fetch_array($query, MYSQLI_BOTH))
    {
      $checkpass = $row[2];

      // Compare password hashes.
      if ($pass === $checkpass)
      {
          $new = TRUE;
          $user = NULL;


          // QUERY FROM DATABASE
          $query2 = mysqli_query($sqli, "SELECT * FROM hero WHERE id = '".$row[0]."'");
          $checknew = mysqli_num_rows($query2);

           // Check if username is matched with existing row
          if($checknew == 1)
          {  

            while ($row2 = mysqli_fetch_array($query2, MYSQLI_BOTH))
            {
              $new = FALSE;
              $user = unserialize($row2[1]);
            }

            $query3 = mysqli_query($sqli, "SELECT * FROM inventory WHERE id = '".$row[0]."'");
            while ($row3 = mysqli_fetch_array($query3, MYSQLI_BOTH))
            {
              $inventory = unserialize($row3[1]);
              console.log('HEY HEY HEY HEY HEY HEY HEY');
            }
          }
          else 
          {
          }
          $userArray = array('id' => $row[0], 'name' => $row[1], 'new' => $new, 'user' => $user, 'inventory' => $inventory);
      } else
      {
        $error = "Passwords do not match";
        $userArray = array('id' => $id, 'error' => $error);
      }
    }   
  }

  return $userArray;
}

function sessionSet($array)
{

  // Starts Session
  session_start();
  $_SESSION['id'] = $array['id'];
  
  if (isset($array['name']))
  {
    $_SESSION['name'] = $array['name'];
    $_SESSION['user'] = serialize($array['user']);
    $_SESSION['inventory'] = serialize($array['inventory']);
  }

  //Calculate 10 days in the future
  //seconds * minutes * hours * days + current time
  $inTenDays = 60 * 60 * 24 * 10 + time(); 

  //$arrayCookie = base64_encode(json_encode($array));
  //User info
  $salt1 = '239h9vn9U#@)jv0*@ng)*3j(1.t42n0)';
  $salt2 = '2fj938vw-J(#)Ngf;@()m//2j';
  $userInfo = sha1(md5($salt1.$array['id']).$salt2);

  setcookie("user", $userInfo, $inTenDays);

}

// Main
if (isset($_POST['usernameInput'], $_POST['passwordInput']))
{

  require "hero.php";
  require 'sql.php';

  // Starts SQL connection
  $sql = getConnected();
  $userArray = validateUser($sql);

  if ( $userArray['id'] > 0 ) {
    


    sessionSet($userArray);

    echo json_encode($userArray);

    exit();
  }
  else
  {
    echo 'Username does not exist';
  }
}
else 
{
  echo "Please enter a username and password.";
}

?>