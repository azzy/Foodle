<?php

//var_dump($_POST);

include_once("foodledbinfo.php");

$db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
$userkey = $_POST['userkey'];

$stmt = $db.prepare("SELECT * FROM users WHERE urlkey = $userkey");
$stmt->execute();
$row = $stmt->fetch();
$pollid = $stmt['pollid'];
$voterid = $stmt['userid'];

// Delete all old votes by this user
$stmt = $db.prepare("DELETE * FROM votes WHERE pollid = $pollid AND voterid = $voterid");
$stmt->execute();

$rank = 1;
for ($_POST as $index => $choiceid) {
  if ($choiceid !== "" and $index !== "userkey") {
    $voteid = "$pollid".".".$voterid.".".$choiceid;
    echo $voteid . "\n";
    $stmt = $db.prepare("INSERT INTO votes VALUES ($voteid, $pollid, $voterid, $choiceid, $rank)");
    $stmt->execute();
    $rank += 1;
  }
}

}

?>