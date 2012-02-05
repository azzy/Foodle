<?php
/* Gets the top $num_results results for a poll, running Kanika's ranking algorithm! */
function genResults($pollid, $num_results) {
  $output = shell_exec("java -cp ../voting-alg/.:../java-common/mysql-connector-java-5.1.18-bin.jar:../java-common/stdlib.jar:../java-common/algs4.jar Choosine ".$pollid);
  if (strpos($output,'ERROR') === 0) {
    // there was an error

  } else {
    include_once('foodledbinfo.php');
    try {
      $db = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);

      $query = "SELECT * FROM polls WHERE pollid = {$pollid}";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $row = $stmt->fetch();
      if (!$row || !array_key_exists('resultstable', $row)) {
	// error finding results table name
	return null;
      }
      $tablename = $row['resultstable'];

      $query = "SELECT * FROM {$tablename}";
      $stmt = $db->prepare($query);
      $stmt->execute();
      $row = $stmt->fetch();
      
      $topchoices = array();

      while ($row) {
	$topchoices[$row['rank']] = $row['choiceid'];
	$row = $stmt->fetch();
      }

      ksort($topchoices);

      $query = "SELECT * FROM choices{$pollid} WHERE choiceid = ?";
      $stmt = $db->prepare($query);
      $stmt->bindParam(1, $thechoiceid);

      $topyelps = array();
      $limitcounter = 0;
      foreach ($topchoices as $rank => $thechoiceid) {
	$stmt->execute();
	$row = $stmt->fetch();
	$topyelps[$rank] = $row['yelpid'];
	$limitcounter += 1;
	if ($limitcounter >= $num_results) {
	  break;
	}
      }
      return $topyelps;

    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      return null; //die();;
    }
  }
  return null;
}
?>