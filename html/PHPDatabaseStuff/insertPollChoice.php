<?php
function insertPollChoice($host,$username, $password, $database, $choiceid, $yelpid, $pollid)
{
    mysql_connect($host,$username,$password);
    @mysql_select_db($database) or die( "Unable to select database");
    string $some_table = "PollChoice".$pollid;
    $query="INSERT INTO '$some_table' VALUES ('$choiceid','$yelpid')";
    $insert = mysql_query($query);
    mysql_close(); 
    return $insert;
}
?>