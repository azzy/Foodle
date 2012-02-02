<?php
include("dbinfo.inc.php");
 $poll = $_POST['poll'];
 $first=$_POST['first'];
 $last=$_POST['last'];
 $email=$_POST['email'];
 mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database"); 

$query = "INSERT INTO contacts VALUES ('','$poll','$first','$last','$email')";
mysql_query($query);

mysql_close();
?> 