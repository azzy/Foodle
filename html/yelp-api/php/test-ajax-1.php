<?php // -*-php-*- (sets emacs to use php mode)
 
$logFile = 'logFile';
$res = json_decode(stripslashes($_POST['data']), true);
error_log("result: ".$_POST['data'].", res=".json_encode($res), 3, $logFile);
error_log(", sales1_lastname: ".$res['sales'][1]['lastname'], 3, $logFile);
error_log("\n", 3, $logFile);
 
header("Content-type: text/plain");
echo json_encode($res);
?>