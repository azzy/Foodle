<?php
$teststr = "onceuponatimetherewas a fairy";
$teststr = "a";

echo "Reg exp results <br/>";
//search stuff
if (preg_match("/^[A-z]([A-z])*[,][A-z]{2}$|^[0-9]{5}$/", "08544")) {
  // echo "matches location";
} else {
  echo "sadface";
}




//location stuff
if (preg_match("/^[A-z]([A-z])*[,][A-z]{2}$|^[0-9]{5}$/", "08544")) {
  // echo "matches location";
} else {
  echo "sadface";
}

// email stuff
$regexp_email = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
$email = "firstname.lastname@aaa.bbb.com";
$regexp_name = "/^[A-z]+";
if (preg_match($regexp_email, $email)) {
  //echo "email is valid";
} else {
  echo "Email address is not valid.";
}


/*
if (preg_match("/[a-zA-Z]+[,][a-zA-Z]{2}/", "Princeton,NJ")) {
    echo "all is well";
} else {
  echo "sadface";
}
*/

?>