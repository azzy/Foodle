<?php
include_once('newuser.php');
include_once('newpoll.php');

$userkey = $_POST['sendValue'];

$userinfo = getUserInfo($userkey);
$numchoices = getPollInfo($userinfo['numchoices']);

echo $numchoices;
?>