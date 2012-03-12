<?php
  // Returns an array of form $choiceid => $rank, with only the votes given by this particular voter
function getUserVotes($pollid, $voterid) {
  include("foodledbinfo.php");
  $votes = array();
  try {
    $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
    $query = "SELECT * FROM votes WHERE pollid = ? AND voterid = ?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $pollid);
    $stmt->bindParam(2, $voterid);
    $stmt->execute();
    $row = $stmt->fetch();
    while($row) {
      $votes[$row['choiceid']] = $row['rank'];
      $row = $stmt->fetch();
    }
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    return $votes; //die();;
  }
  $db = null;
  return $votes;
}
?>