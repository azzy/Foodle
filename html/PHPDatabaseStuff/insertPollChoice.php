<?php
function insertPollChoice($host,$username, $password, $database, $choiceid, $yelpid, $pollid)
{
    mysql_connect($host,$username,$password);
    @mysql_select_db($database) or die( "Unable to select database");
    $query="INSERT INTO PollChoice".$pollid." VALUES ('$choiceid','$yelpdid')";
    $insert = mysql_query($query);
    mysql_close(); 
    return $insert;
}
?>