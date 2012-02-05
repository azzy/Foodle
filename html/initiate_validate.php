<?php

include("validateRun.php");
require_once("functions/newuser.php");
require_once("functions/newpoll.php");

// Uncomment these to run tests (test data)
//$_POST['dinner'] = "fun dinner";
//$_POST['name'] = "somebody special";
//$_POST['email'] = "2134m";
//$_POST['location'] = "Princeton, NJ";
//echo 'DINNER';

//echo "reached";

$isValid = isValid($_POST['email'], $_POST['location']);

if($isValid) {
  //echo "AAAAAAAAAARRRRRGHHHHHH";
  // TODO: if the form data is valid, save it to the database
  $pollid = newPoll($_POST['dinner'], $_POST['location']);
  // create an admin user for the poll
  $userkey = newUser($pollid, 'a', $_POST['email'], $_POST['name']);
}

if ($isValid) {
  echo "true";
} else {
  echo "false";
}

?>

