<?php 
$pollid = 0 + 0;
$output = shell_exec("java -cp ../voting-alg/.:../java-common/mysql-connector-java-5.1.18-bin.jar:../java-common/stdlib.jar:../java-common/algs4.jar Choosine ".$pollid);
echo $output;
?>