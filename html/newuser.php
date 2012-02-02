<?php
require_once("urlkey_generator.php");

/* Generates a new user for a poll, and returns their unique access key (for the url). */
function NewUser(int $pollid, string $usertype, string $email) {
  $urlkey = NewGuid();

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $userid = -1;
    if ($stmt = $db->prepare("SELECT numvoters FROM polls WHERE pollid = ".$pollid)) {
      $row = $stmt->fetch();
      if ($row) {
	$userid = $row->numvoters;
      }
    }
    echo $userid;

    //'$poll','$first','$last','$email')";
    if ($stmt = $db->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?)")) {
      $stmt->bindParam(1, $urlkey);
      $stmt->bindParam(2, $pollid);
      $stmt->bindParam(3, $userid);
      $stmt->bindParam(4, $usertype);
      $stmt->bindParam(4, $email);
      $stmt->execute();
    }

    $query = "UPDATE polls SET numvoters = ? WHERE pollid = $pollid";
    if ($stmt = $db->prepare($query)) {
      $stmt->bindParam(1, $userid); // since they're indexed from 1, the userid == the total
      $stmt->execute();
    }

    $db = null;
    //mysql_query($query);
    //mysql_close();
    
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();;
  }

  return $urlkey;
}
?>