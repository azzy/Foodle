<?php
$output = shell_exec("java -cp ../cron-jobs/.:../java-common/algs4.jar:../java-common/stdlib.jar:../java-common/jsoup-1.6.1.jar grabInfoBetter");
echo $output;
?>