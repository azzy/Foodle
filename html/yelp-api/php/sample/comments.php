<?php

	//db connection detils
	$host = "localhost";
  $user = "root";
  $password = "your_password_here";
  $database = "comments";
	
	//make connection
  $server = mysql_connect($host, $user, $password);
  $connection = mysql_select_db($database, $server);
	
	//query the database
  $query = mysql_query("SELECT * FROM comments");
	
	//loop through and return results
  for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
		$row = mysql_fetch_assoc($query);
    
		$comments[$x] = array("name" => $row["name"], "comment" => $row["comment"]);		
	}
	
	//echo JSON to page
	$response = $_GET["jsoncallback"] . "(" . json_encode($comments) . ")";
	echo $response;

?>