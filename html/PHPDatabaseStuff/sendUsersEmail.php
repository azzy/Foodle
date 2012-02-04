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


<?php
function sendPollEmail($pollid)
{
include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db("foodle") or die( "Unable to select database");
$query="SELECT * FROM users WHERE pollid='$id'";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();
$i=0;
while ($i < $num) {
if((mysql_result($result,$i,"usertype") == 'a') $from=mysql_result($result,$i,"email");
++$i;
}
while ($i < $num) {
$to =mysql_result($result,$i,"email");
sendEmail($to, "www.choosine.com", $from);
++$i;
}
}
?>

<?php
sendPollEmail("14");
?>