<?php
    require_once ('lib/OAuth.php');
    include_once("access.php");
    include_once("parse.php");
    include_once("foodledbinfo.php");
    include_once("newpoll.php");
    include_once("newuser.php");
    
//$userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
/*$userkey = $_GET['userkey'];  
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];*/
    
    $arrOfIds = getPollChoices($pollid);
    
//$arrOfIds = array("the-bent-spoon-princeton", "witherspoon-grill-princeton", "nassau-sushi-princeton");
    
    //echo("<br/><br/>");
    function addItems($arrOfIds) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $response=getData($arrOfIds[$i]);
            $id = $response[$id];
	    $name = $response[$name];
            echo '<li class="draggable heading" id="'.$id.'">'.$name.'</li>';
        }
    }
    
    function getData($business) {
        
        // create URL and get Yelp response
        $unsigned_url = "http://api.yelp.com/v2/business/".$business;
        $data = access($unsigned_url);
        $response = json_decode($data);
        
        //print_r($response);
        $id = $response->id;
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
        $arr = array("id"=>$id, "name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "categories"=>$category, "url"=>$url);
        return ($arr);
        
    }    
    
/*
<html>
    <head>
        <title>Test</title>
    </head>

<body>
    lalalala
    <p><?php echo("userkey ".$userkey." pollid ".$pollid."<br/><br/>");?></p>
    <p><?php print_r($arrOfIds);?></p>
    <ul id='restlist'>
        <?php addItems($arrOfIds); ?>
    </ul>
</body>
</html>
*/
?>
