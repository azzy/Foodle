<?php
  /*******************************************
/* formmatch.php
/* php functions to match various form data
/* Functions for:
/*    search, location(zip code or town,st),
/*    name, email
  *********************************************/

//search
function msearch($str) {
  return (preg_match("/^.*$", $str));
  }

//location - (zip)|(town,st)|(town,st,zip)
function mlocation($loc) {
  $loc = str_replace(" ", "", $loc);
  $regexp_loc = "/^[A-z]+[,][A-z]{2}$|^[0-9]{5}$|^[A-z]+[,][A-z]{2}[,]*[0-9]{5}$/";
  return (preg_match($regexp_loc, $loc));
}

// email
function memail($email) {
  $regexp_email = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
  return (preg_match($regexp_email, $email));
}

// name
function mname($name) {
  $regexp_name = "/^[A-z]+/";
  return(preg_match($regexp_name, $name));
}

//Testing:
/*
echo "Test Results <br/>";

if(mlocation("Princeton, NJ")) {
  echo "all good";
}
else {
  echo "Noppeee fix it";
}
*/

?>