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
include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db("foodle") or die( "Unable to select database");
$query="SELECT * FROM users";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();
$i=0;
while ($i < $num) {
$to=mysql_result($result,$i,"email");
$c = mysql_result($result,$i,"pollid");
$j = 0;
while ($j < $num){
$from=mysql_result($result,$i,"email");
if ((mysql_result($result,$i,"usertype") == 'a') && (mysql_result($result,$i,"pollid") == $c)) sendEmail($to, "www.choosine.com", $from)
++$j;
}
++$i;
} 
?>