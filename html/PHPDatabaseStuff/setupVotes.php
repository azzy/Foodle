<?php
function setupVotes($host,$username, $password, $database, $pollid){
    mysql_connect($host,$username,$password);
    @mysql_select_db($database) or die( "Unable to select database");
    $query="CREATE TABLE Votes".$pollid." (userid int(10) NOT NULL, choiceid int(10) NOT NULL, rank int(10) NOT NULL)";
    $setupV = mysql_query($query);
    mysql_close(); 
    return $setupV;
}
?>