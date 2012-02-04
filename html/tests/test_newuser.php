<?php

include_once("functions/newuser.php");
include_once("functions/newpoll.php");
$pollid = newPoll("a SUPER fun event", "princeton university");
echo $pollid;
$key = newUser($pollid, 'a', "cbutton9@gmail.com", "Candy");
echo $key;
echo $info = getUserInfo($key);
echo $info['urlkey'];

//echo getUserInfo($key);
//updateUserName($key, "Kanika");

?>
