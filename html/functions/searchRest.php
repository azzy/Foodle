<?php
require_once ('lib/OAuth.php');
include("access.php");
include("parse.php");
include_once('newuser.php');
include_once('newpoll.php');

$userinfo = getUserInfo($userkey);
$pollinfo = getPollInfo($userinfo['pollid']);
//$location = $pollinfo['location'];
$location = 08544;

if (empty($_POST['sendValue'])) {
    echo json_encode(array("returnValueName"=>"This is name from PHP : ", "returnValueId"=>"This is id from PHP : "));
}
else {
    $name = str_replace(" ", "+", $_POST['sendValue']);
    $unsigned_url = "http://api.yelp.com/v2/search?term=".$name."&location=".$location."&limit=2&category_filter=food,restaurants";
    $data = access($unsigned_url);
    $response = json_decode($data);
    echo json_encode(array("returnValueName"=>name($response, 0), 
			   "returnValueId"=>id($response, 0), 
			   "returnValueRating"=> "Rating: ".rating($response,0), 
			   "returnValueRatingImg"=>ratingimg($response,0), 
			   "returnValueSnippet"=> "Review: ".snippet($response,0), 
			   "returnValueCategory"=>"Categories: ".categories($response,0)
			   "returnValueURL"=>"<a href=\"".url($response,0)."\">Read more on Yelp.com</a>"
));}


?>
