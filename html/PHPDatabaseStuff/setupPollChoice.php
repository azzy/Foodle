<?php
function setupPollChoice($host,$username, $password, $database, $pollid)
{
    mysql_connect($host,$username,$password);
    @mysql_select_db($database) or die( "Unable to select database");
    $some_table = "PollChoice".$pollid;
    $query="CREATE TABLE '$some_table' (choiceid int(10) NOT NULL, yelpid varchar(100) NOT NULL)";
    $setup = mysql_query($query);
    mysql_close(); 
    return $setup;
}
?>