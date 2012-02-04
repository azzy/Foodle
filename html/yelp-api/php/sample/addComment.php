<?php

  //db connection detils
  $host = "localhost";
  $user = "root";
  $password = "your_password_here";
  $database = "comments";
	
  //make connection
  $server = mysql_connect($host, $user, $password);
  $connection = mysql_select_db($database, $server);
	
  //get POST data
  $name = mysql_real_escape_string($_POST["author"]);
  $comment = mysql_real_escape_string($_POST["comment"]);

  //add new comment to database
  mysql_query("INSERT INTO comments VALUES(' $name ',' $comment ')");

?>