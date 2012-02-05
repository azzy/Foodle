<?php

require_once ('lib/OAuth.php');
include("access.php");
include("parse.php");

$loc = $_POST['location'];
$num = 10; // max number of restaurants to return

// create URL and get Yelp response
$unsigned_url = "http://api.yelp.com/v2/search?&location=".$loc."&limit=".$num."&category_filter=food,restaurants";
$data = access($unsigned_url);
$response = json_decode($data);
//print_r($response);
$num = count($response->businesses);
$arr = array("num"=>$num);

for ($i = 0; $i < $num; $i++) {
  $arrRest = array("name"=>name($response, $i), "id"=>id($response, $i), "rating"=>rating($response, $i), "ratingimg"=>ratingimg($response, $i), "snippet"=>snippet($response, $i),  "categories"=>categories($response, $i), "url"=>'<a href="'.url($response, $i).'">Read more on Yelp.com</a>');
    $index = $i;
    $arr[$index] = $arrRest;
}
echo json_encode($arr);

//print_r(json_decode(json_encode($arr)));






?>
