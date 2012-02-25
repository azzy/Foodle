<?php
require_once("urlkey_generator.php");

/* Generates a new user for a poll, and returns their unique access key (for the url). */
function newUser($pollid, $usertype, $email, $name = NULL) {
  $urlkey = NewGuid();

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $userid = -1;
    if ($stmt = $db->prepare("SELECT numvoters FROM polls WHERE pollid = ".$pollid)) {
      $stmt->execute();
      $row = $stmt->fetch();
      if ($row) {
	$userid = $row['numvoters'];
	$userid++;
      }
      else {
        print "Error!: Could not fetch the number of voters in your poll.";
	return; //die();
      }
    }

    //'$poll','$first','$last','$email')";
    if ($stmt = $db->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?)")) {
      $stmt->bindParam(1, $urlkey);
      $stmt->bindParam(2, $pollid);
      $stmt->bindParam(3, $userid);
      $stmt->bindParam(4, $usertype);
      $stmt->bindParam(5, $email);
      $stmt->bindParam(6, $name);
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
    return; //die();;
  }

  return $urlkey;
}

/* Gets the user info, including userid and pollid, from the database using the url key
   for that user. Returns the data in an associative array. */
function getUserInfo($urlkey) {

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $userid = -1;
    if ($stmt = $db->prepare("SELECT * FROM users WHERE urlkey = ?")) {
      $stmt->bindParam(1, $urlkey);
      $stmt->execute();
      $row = $stmt->fetch();
      if ($row) {
	return $row;
      }
    }
    return NULL;
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    return NULL; //die();;
  }
}

function updateUser($urlkey, $name, $email) {

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $query = "UPDATE users SET username = ? WHERE urlkey = ?";
    if ($stmt = $db->prepare($query)) {
      $stmt->bindParam(1, $name); 
      $stmt->bindParam(2, $urlkey);
      $stmt->execute();
    }

    $query = "UPDATE users SET email = ? WHERE urlkey = ?";
    if ($stmt = $db->prepare($query)) {
      $stmt->bindParam(1, $email); 
      $stmt->bindParam(2, $urlkey);
      $stmt->execute();
    }

    $db = null;
    
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    return; //die();;
  }
}
?>