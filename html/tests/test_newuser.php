<?php

include_once("newuser.php");
$key = newUser(0, 'a', "cbutton9@gmail.com", "Candy");
echo $key;
echo getUserInfo($key);
updateUserName($key, "Kanika");

?>
