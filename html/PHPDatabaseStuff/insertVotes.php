<?php
function insertVotes($host,$username, $password, $database, $pollid, $userid, $choiceid, $rank)
{
    mysql_connect($host,$username,$password);
    @mysql_select_db($database) or die( "Unable to select database");
    $query="INSERT INTO Votes".$pollid." VALUES ('$userid','$choiceid','$rank')";
    $insertv = mysql_query($query);
    mysql_close(); 
    return $insertv;
}
?>