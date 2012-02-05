<?php
    require_once ('lib/OAuth.php');
    include("access.php");
    include("parse.php");
    include("formmatch.php");
    include("foodledbinfo.php");
    include("newpoll.php");
    include("newuser.php");
    
    //$userkey = $_GET['userkey'];
    $userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];
    
    echo("userkey ".$userkey." pollid ".$pollid);
    echo("<br/><br/>");
    
    $arrOfIds = getPollChoices($pollid);
    $num = count($arrOfIds);
    print_r($arrOfIds);
    echo("<br/><br/>");
    echo("num ".$num);
    echo("<br/><br/>");
    echo("<ul>");
    for ($i = 0 ; $i < $num; $i++) {
        $response=getData($arrOfIds[$i]);
        $name = $response[name];
        echo("<li class='restaurant'>".$name."<li>");
    }
    echo("</ul>");
        
    function getData($business) {
        // create URL and get Yelp response
        $unsigned_url = "http://api.yelp.com/v2/business/".$business;
        $data = access($unsigned_url);
        $response = json_decode($data);
        
        //print_r($response);
        
        $name = $response->name;
        $rating = $response->rating;
        $ratingimg = $response->rating_img_url;
        $url = $response->url;
        $location = ($response->location->city) . "," . ($response->location->state_code);
        $category = "";  
        for ($i = 0; $i < count($response->categories); $i++) {
            $category = $category.$response->categories[$i];
        }    
        //name, rating, rating_img_url, url, categories, city, state
        $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "categories"=>$category, "url"=>$url);
        return ($arr);
    }
?>