<?php
require_once("urlkey_generator.php");

/* Generates a new user for a poll, and returns their unique access key (for the url). */
function NewUser(int $pollid, string $usertype, string $email, string $name = NULL) {
  $urlkey = NewGuid();

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $userid = -1;
    if ($stmt = $db->prepare("SELECT numvoters FROM polls WHERE pollid = ".$pollid)) {
      $row = $stmt->fetch();
      if ($row) {
	$userid = $row->numvoters;
	$userid++;
      }
    }
    echo $userid;

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
    die();;
  }

  return $urlkey;
}

/* Gets the user info, including userid and pollid, from the database using the url key
   for that user. Returns the data in an associative array. */
function getUserInfo(int $urlkeystring) {

  include("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $userid = -1;
    if ($stmt = $db->prepare("SELECT * FROM users WHERE urlkey = ".$urlkeystring)) {
      $row = $stmt->fetch();
      if ($row) {
	return $row;
      }
    }
    return NULL;
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();;
  }
}

function updateUserName(string $urlkey, string $name) {

  include_once("foodledbinfo.php");

  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

    $query = "UPDATE users SET username = ? WHERE urlkey = ?");
    if ($stmt = $db->prepare($query)) {
      $stmt->bindParam(1, $name); // since they're indexed from 1, the userid == the total
      $stmt->bindParam(2, $urlkey);
      $stmt->execute();
    }

    $db = null;
    
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();;
  }
}
?>