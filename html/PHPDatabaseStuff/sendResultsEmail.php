<?php
function getPollEmails ($pollid) {
  include("dbinfo.inc.php");
  mysql_connect('localhost',$username,$password);
  @mysql_select_db($database) or die( "Unable to select database");
  $query="SELECT * FROM users WHERE pollid={$pollid}";
  $result=mysql_query($query);
  mysql_close();

  return $result;
}

function initResultsEmail($pollEmails) {
  $num=mysql_numrows($pollEmails);
  $i = 0;
  while ($i < $num) {
    echo '<input type="checkbox" name="list" value="'.$i'" />'.mysql_result($pollEmails,$i,"email").'<br />';
    ++$i;
  }
}

function sendEmail($to, $from, $subject, $body)
{ 
  //$subject = "via Choosine: Where should we go eat?";
  //echo $body = "I've created a poll to pick a dinner location. Please visit $url to submit your preferences" + $input;
  //$body = $message."\n\nPlease visit ".$url." to submit your preferences.";

  $headers = "From:".$from."\n";
  // echo 'from:'.$from.'\nto:'.$to.$subject.$body;
  $send = mail($to,$subject,$body,$headers);
  //echo $send;
  return $send;
}
?>