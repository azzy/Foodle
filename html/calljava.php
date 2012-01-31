<?php 
$output = shell_exec("java -cp ../voting-alg/ choosineGen");
echo $output;
?>