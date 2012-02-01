<?php 
$output = shell_exec("java -cp ../voting-alg/mysql-connector-java-5.1.18-bin.jar:../voting-alg/. Choosine 0");
echo $output;
?>