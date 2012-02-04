<?php

//var_dump($_POST);

include_once("foodledbinfo.php");

$db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

/*
$_POST = array();
$_POST['userkey'] = '3C3C75BC-BD19-3C9C-5C44-5854BBA5BE7F';
$_POST['0'] = '';
$_POST['1'] = '2';
$_POST['2'] = '4';
$_POST['3'] = '3';
*/
$userkey = $_POST['userkey'];

$stmt = $db->prepare("SELECT * FROM users WHERE urlkey = '$userkey'");
//echo "SELECT * FROM users WHERE urlkey = $userkey" . "\n";
//echo $stmt->execute() . "\n";
$row = $stmt->fetch();
$pollid = $row['pollid'];
$voterid = $row['userid'];

// Delete all old votes by this user
$stmt = $db->prepare("DELETE FROM votes WHERE pollid = $pollid AND voterid = $voterid");
//echo "DELETE FROM votes WHERE pollid = $pollid AND voterid = $voterid" . "\n";
//echo $stmt->execute() . "\n";

$rank = 1;
foreach ($_POST as $index => $choiceid) {
  if ($choiceid !== "" and $index !== "userkey") {
    $voteid = "$pollid".".".$voterid.".".$choiceid;
    //echo $voteid . "\n";
    $stmt = $db->prepare("INSERT INTO votes VALUES (?, $pollid, $voterid, $choiceid, $rank)");
    $stmt->bindParam(1, $voteid);
    //echo "INSERT INTO votes VALUES (?, $pollid, $voterid, $choiceid, $rank)" . "\n";
    //echo $stmt->execute() . "\n";
    $rank += 1;
  }
}

?>