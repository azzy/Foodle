<?php

include_once("functions/newuser.php");
include_once("functions/newpoll.php");
$pollid = newPoll("a SUPER fun event", "princeton university");
echo $pollid;
$key = newUser($pollid, 'a', "cbutton9@gmail.com", "Candy");
$userinfo = getUserInfo($key);
$pollinfo = getPollInfo($pollid);

echo $pollinfo['location'];

//echo getUserInfo($key);
//updateUserName($key, "Kanika");

?>
