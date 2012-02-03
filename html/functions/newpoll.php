<?php

/* Generates a poll, and returns the poll id. Does not create any users; this poll may not have an admin. */
function newPoll($dinner, $location) {

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    // TODO: Error handling on all "prepare" calls (results could be null)!!!

    // find a new available poll id, guessing that it will be at least as high as the count plus the first item's id
    $pollid = -1;
    $stmt = $db->prepare("SELECT pollid FROM polls");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
      $pollid = $row[0];
    }
    else {
      print "ERROR: couldn't select any pollid in the polls table";
    }

    $stmt = $db->prepare("SELECT COUNT(*) FROM polls");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
      $pollid += $row[0];
    }
    else {
      print "ERROR: couldn't select count from polls table!";
    }

    // If we failed to find a unique id, iterate forward and keep trying
    $stmt = $db->prepare("SELECT * FROM polls WHERE pollid = $pollid");
    $stmt->execute();
    $row = $stmt->fetch();
    while ($row) {
      $pollid += 1;
      $stmt = $db->prepare("SELECT * FROM polls WHERE pollid = $pollid");
      $stmt->execute();
      $row = $stmt->fetch();
    }

    $stmt = $db->prepare("INSERT INTO polls VALUES (?, 0, 0, NULL, ?, ?)");
    $stmt->bindParam(1, $pollid);
    $stmt->bindParam(2, $dinner);
    $stmt->bindParam(3, $location);
    $stmt->execute();

    $db = null;
    
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();;
  }

  return $pollid;
}

?>