<?php
include_once("dbinfo.inc.php");

$poll = $_POST['poll'];
$first=$_POST['first'];
$last=$_POST['last'];
$email=$_POST['email'];
echo $poll;
echo $first;
echo $last;
echo $username;
echo $email;

//mysql_connect('localhost',$username,$password);
//mysql_select_db($database) or die( "Unable to select database"); 
//$db = new mysqli('localhost', $username, $password, $database);
try {
  $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

  $query = "INSERT INTO contacts VALUES ('', ?, ?, ?, ?)";
  //'$poll','$first','$last','$email')";

  if ($stmt = $db->prepare($query)) {
    $stmt->bindParam(1, $poll);
    $stmt->bindParam(2, $first);
    $stmt->bindParam(3, $last);
    $stmt->bindParam(4, $email);
    $stmt->execute();
  }

  $db = null;
  //mysql_query($query);
  //mysql_close();

} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();;
}



?> 