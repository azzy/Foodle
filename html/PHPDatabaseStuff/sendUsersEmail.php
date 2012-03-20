<?php
function sendEmail($to, $url, $from, $subject, $input)
{ 
  //$subject = "via Choosine: Where should we go eat?";
  //echo $body = "I've created a poll to pick a dinner location. Please visit $url to submit your preferences" + $input;
  $body = $input."\n\nPlease visit ".$url." to submit your preferences.";
  $headers = "From:".$from."\n";
  $send = mail($to,$subject,$body,$headers);
  return $send;
}
function sendPollEmail($pollid, $type, $userSubj, $userBody)
{
  include("dbinfo.inc.php");
  //echo "2";
  mysql_connect('localhost',$username,$password);
  @mysql_select_db($database) or die( "Unable to select database");
  $query="SELECT * FROM users WHERE pollid={$pollid}";
  $result=mysql_query($query);
  $num=mysql_numrows($result); 
  mysql_close();
  $i=0;
  // default value
  $from="mailer@choosine.com";
  while ($i < $num) {
    if(mysql_result($result,$i,"usertype") == 'a') {
      $from=mysql_result($result,$i,"email");
      break;
    }
    ++$i;
  }
  $i=0;
  while ($i < $num) {
    if(mysql_result($result,$i,"usertype") == 'v') {
      $to =mysql_result($result,$i,"email");
      $userkey=mysql_result($result,$i,"urlkey");
      sendEmail($to, "http://www.choosine.com/ranksort.php?type={$type}&userkey={$userkey}", $from, $userSubj, $userBody);
    }
    ++$i;
  }
}
?>