<?php
include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM contacts;
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();

$i=0;
while ($i < $num) {
$poll=mysql_result($result,$i,"poll");
$first=mysql_result($result,$i,"first");
$last=mysql_result($result,$i,"last");
$email=mysql_result($result,$i,"email");

?>

<form action="updated.php">
<input type="hidden" name="ud_id" value="<? echo "$id"; ?>">
Poll ID: <input type="text" name="ud_poll" value="<? echo "$poll"?>"><br>
First Name: <input type="text" name="ud_first" value="<? echo "$first"?>"><br>
Last Name: <input type="text" name="ud_last" value="<? echo "$last"?>"><br>
E-mail Address: <input type="text" name="ud_email" value="<? echo "$email"?>"><br>
<input type="Submit" value="Update">
</form>

<?
++$i;
} 
?>