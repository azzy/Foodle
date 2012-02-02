<?php

$ud_id=$_POST['ud_id'];
 $ud_poll=$_POST['ud_poll'];
 $ud_first=$_POST['ud_first'];
 $ud_last=$_POST['ud_last'];
 $ud_email=$_POST['ud_email'];
 include("dbinfo.inc.php");
mysql_connect(localhost,$username,$password);

$query="UPDATE contacts SET poll= '$ud_poll',first='$ud_first', last='$ud_last', email='$ud_email'";
@mysql_select_db($database) or die( "Unable to select database");
mysql_query($query);
echo "Record Updated";
mysql_close();
?>