<?php

    require_once ('lib/OAuth.php');
    include("access.php");
    include("parse.php");
    include("formmatch.php");

    $business = $_POST['sendValue'];

    // create URL and get Yelp response
    $unsigned_url = "http://api.yelp.com/v2/business/".$business;
    $data = access($unsigned_url);
    $response = json_decode($data);
    
    print_r($response);
    
    //http://www.yelp.com/biz/the-bent-spoon-princeton
    
    

?>

