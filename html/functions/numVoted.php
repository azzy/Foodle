<?php

/* Get the number of users who have voted so far in the poll (via the "votes" table in 
   the database). */
function numVoted ($pollid) {

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $users = array();
    $stmt = $db->prepare("SELECT * FROM votes WHERE pollid = ".$pollid);
    $stmt->execute();
    $row = $stmt->fetch();
    while ($row) {
      $users[$row['voterid']] = $row['voterid'];
      $row = $stmt->fetch();
    }

  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    //die();;
  }

  return count($users);
}

/* Returns the number of voters in a poll, or 0 if the poll can't be found. */
function numVoters ($pollid) {

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $users = array();
    $stmt = $db->prepare("SELECT numvoters FROM polls WHERE pollid = ".$pollid);
    $stmt->execute();
    $row = $stmt->fetch();
    if($row) {
      return $row['numvoters'];
    }

  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    //die();;
  }

  return 0;
}

?>
