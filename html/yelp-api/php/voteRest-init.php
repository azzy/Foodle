<?php

    require_once ('lib/OAuth.php');
    include("access.php");
    include("parse.php");
    include("formmatch.php");

    //$business = $_POST['sendValue'];
    $business = "the-bent-spoon-princeton";

    // create URL and get Yelp response
    $unsigned_url = "http://api.yelp.com/v2/business/".$business;
    $data = access($unsigned_url);
    $response = json_decode($data);
    
    print_r($response);
    /*
    $name = $response=>name;
    $rating = $response=>rating;
    $ratingimg = $response=>rating_img_url;
    $url = $response=>url;
    $location = $response=>location=>city . "," . $response=>location=>state_code;
    $category = "";
    /*
    for ($i = 0; $i < count($response=>categories); $i++) {
        $category = $category.$response=>categories[$i];
    }
    
    "categories"=>$category,
    /
    
    $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "url"=>$url);
    
    echo json_encode($arr);
    */
    //name, rating, rating_img_url, url, categories, location=>city, location=>state_code
    
    //http://www.yelp.com/biz/the-bent-spoon-princeton
    
    

?>

