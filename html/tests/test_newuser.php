<?php

include_once("functions/newuser.php");
include_once("functions/newpoll.php");
$pollid = newPoll("a fun event", "princeton university");
echo $pollid;
$key = newUser($pollid, 'a', "cbutton9@gmail.com", "Candy");
echo $key;

//echo getUserInfo($key);
//updateUserName($key, "Kanika");

?>
