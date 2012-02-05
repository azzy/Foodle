<?php

include_once("functions/newuser.php");
include_once("functions/newpoll.php");
$pollid = 86; //newPoll("a SUPER fun event", "princeton university");
//echo $pollid;
$key = newUser($pollid, 'a', "cbutton9@gmail.com", "Candy");
$userinfo = getUserInfo($key);
$pollinfo = getPollInfo($pollid);

$choices = getPollChoices($pollid);
foreach ($choices as $choice) {
  echo $choice . "\n";
}

//echo getUserInfo($key);
//updateUserName($key, "Kanika");

?>
