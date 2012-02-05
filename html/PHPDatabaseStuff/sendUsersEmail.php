<?php
function sendEmail($to, $url, $from)
{ 
 $subject = "via Choosine: Where should we go eat?";
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
echo "2";
mysql_connect(localhost,$username,$password);
@mysql_select_db("testfoo") or die( "Unable to select database");
$query="SELECT * FROM users WHERE pollid='$id'";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();
$i=0;
while ($i < $num) {
if(mysql_result($result,$i,"usertype") == 'a') $from=mysql_result($result,$i,"email");
++$i;
}
$i=0;
while ($i < $num) {
$to =mysql_result($result,$i,"email");
echo $to;
sendEmail($to, "www.choosine.com", $from);
echo "yes";
++$i;
}
}
?>

<?php
sendPollEmail("0");
echo "blah";
?>
