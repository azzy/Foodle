<?php

include("validateRun.php");
require_once("functions/newuser.php");
require_once("functions/newpoll.php");

// Uncomment these to run tests (test data)
//$_POST['dinner'] = "fun dinner";
//$_POST['name'] = "somebody special";
//$_POST['email'] = "an email";
//$_POST['location'] = "someplace";
//echo 'DINNER';


$isValid = isValid($_POST['email'], $_POST['location']);

// BIGGER TODO: Cache all of this "new poll" and "new user" data, but 
// don't write it to the real database until the user selects CREATE POLL!

// Possible TODO: create greater security through cookies rather than the 
// userkey querystring parameter, and maybe keep a "state" value to represent
// how far through the form progression they've gotten

if ($isValid) {
  // TODO: if the form data is valid, save it to the database
  $pollid = newPoll($_POST['dinner'], $_POST['location']);
  // create an admin user for the poll
  $userkey = newUser($pollid, 'a', $_POST['email'], $_POST['name']);
}

?>