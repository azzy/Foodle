<?php

/* Gets the current results for a poll, running Kanika's ranking algorithm! */
function genResults($pollid) {
  $output = shell_exec("java -cp ../voting-alg/.:../java-common/mysql-connector-java-5.1.18-bin.jar:../java-common/stdlib.jar:../java-common/algs4.jar Choosine ".$pollid);
  echo $output;
}
genResults(0);
?>