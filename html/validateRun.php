<?php

 
function isValid($email, $location){
include("validate.php");
if(memail($email) && mlocation($location)) {//echo "true";
return true;
}
//echo "false";
return false;
}
?>
