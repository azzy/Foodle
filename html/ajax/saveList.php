<?php

//var_dump($_POST);

include_once("foodledbinfo.php");

$db = new PDO("mysql:host=localhost;dbname={$database}", $username, $password);


//ob_start();

// testing stuff only
/*
$_POST = array();
$_POST['userkey'] = 'B3EF2465-24E8-AC67-5076-0D3C22571FD0';
$_POST['nominate'] = 'true';
$_POST['0'] = '';
$_POST['1'] = 'toast';
$_POST['2'] = 'eggs';
$_POST['3'] = 'bagel';
*/
//*/

$userkey = $_POST['userkey'];

if ( !array_key_exists('nominate', $_POST)) {
  echo "ERROR: is this the nomination page or not?";
  die();
}

$stmt = $db->prepare("SELECT * FROM users WHERE urlkey = '$userkey'");
//echo "SELECT * FROM users WHERE urlkey = $userkey" . "\n";
$stmt->execute();
$row = $stmt->fetch();

if ( !array_key_exists('pollid', $row)) {
  echo "ERROR? User not found.";
  die();
}

$pollid = $row['pollid'];
$voterid = $row['userid'];
$nominate = $_POST['nominate'];

if ($nominate) {
  /* Save the poll choices! Yay! */
  $tablename = "choices{$pollid}";

  // Replace the choice table, if it exists
  $query = "DROP TABLE {$tablename}"; // TODO: make this robust for failures between these two lines!!!
  $stmt = $db->prepare($query);
  $stmt->execute();

  $query = "CREATE TABLE {$tablename} (choiceid INT PRIMARY KEY, yelpid VARCHAR(100))";
  $stmt = $db->prepare($query);
  $stmt->execute();

  $choiceid = 0;
  foreach ($_POST as $index => $yelpid) {
    if ($yelpid !== "" and $index !== "userkey" and $index !== "nominate") {
      $query = "INSERT INTO {$tablename} VALUES ({$choiceid}, ?)";
      $stmt = $db->prepare($query);
      $stmt->bindParam(1, $yelpid);
      $stmt->execute();
      $choiceid += 1;
    }
  }
} else {
  /* Save the user's votes! Yay! */

  // Delete all old votes by this user
  $stmt = $db->prepare("DELETE FROM votes WHERE pollid = $pollid AND voterid = $voterid");
  $stmt->execute();
  
  $rank = 1;
  foreach ($_POST as $index => $yelpid) {
    if ($yelpid !== "" and $index !== "userkey" and $index !== "nominate") {
      // Get the choiceid for the yelpid
      $query = "SELECT choiceid FROM choices{$pollid} WHERE yelpid = ?";
      echo($query.$yelpid."\n");
      $stmt = $db->prepare($query);
      $stmt->bindParam(1, $yelpid);
      $stmt->execute();
      $row = $stmt->fetch();
      if ($row and array_key_exists('choiceid', $row)) {
	$choiceid = $row['choiceid'];
	$voteid = "$pollid".".".$voterid.".".$choiceid;
	
	$stmt = $db->prepare("INSERT INTO votes VALUES (?, $pollid, $voterid, $choiceid, $rank)");
	$stmt->bindParam(1, $voteid);
	
	$stmt->execute();
	$rank += 1;
      }
      else {
	echo("Bad yelp id: {$yelpid}");
	// error handle? bad yelp id
      }
    }
  }
}

/*
$string = ob_get_clean();
$file = fopen('siterecords', 'a') or die("can't open file");
fwrite($file, $string);
fclose($file);
*/
?>