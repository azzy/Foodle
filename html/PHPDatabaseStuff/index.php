<?php
include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM contacts";
$result=mysql_query($query);

$num=mysql_numrows($result); 

mysql_close();

echo "<b><center>Database Output</center></b><br><br>";

?>
<table border="0" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Poll ID</font></th>
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">E-mail</font></th>
</tr>

<?
$i=0;
while ($i < $num) {
$poll=mysql_result($result,$i,"poll");
$first=mysql_result($result,$i,"first");
$last=mysql_result($result,$i,"last");
$email=mysql_result($result,$i,"email");
?>

<tr> 
<td><font face="Arial, Helvetica, sans-serif"><? echo "$poll"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$first $last"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><a href="mailto:<? echo "$email"; ?>">E-mail</a></font></td>
</tr>
<?
++$i;
} 
echo "</table>";


?>
