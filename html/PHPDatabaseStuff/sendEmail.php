<?php
function sendEmail($to, $url, $from)
{ 
 $subject = "Where should we go eat?";
 $body = "I've created a poll to pick a dinner location. Please visit $url to submit your preferences";
 $headers = "From:".$from."\n";
 $send = mail($to,$subject,$body,$headers);
 return $send;
}
?>