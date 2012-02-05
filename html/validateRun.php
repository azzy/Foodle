<?php

include("validate.php"); 
require_once("functions/newuser.php");
require_once("functions/newpoll.php");


function isValid($email, $location){
if(memail($email) && mlocation($location)) {//echo "true";
return true;
}
//echo "false";
return false;
}


}

?>