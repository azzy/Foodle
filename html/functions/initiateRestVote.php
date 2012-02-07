<?php
require_once ('lib/OAuth.php');
include_once("access.php");
include_once("parse.php");
include_once("foodledbinfo.php");
include_once("newpoll.php");
include_once("newuser.php");
//$arrOfIds = array("the-bent-spoon-princeton", "witherspoon-grill-princeton", "nassau-sushi-princeton");
  
    
function addItems($arrOfIds) {
  $num = count($arrOfIds);
  for ($i = 0 ; $i < $num; $i++) {
    $response=getData($arrOfIds[$i]);
    $id = $response["id"];
    $name = $response["name"];
    echo '<li class="draggable heading" id="'.$id.'">'.$name;
    echo '<ul class="info ui-state-disabled">
<li class="yelprating ui-state-disabled"><img src="'.$response['ratingimg'];
    echo '" /></li>
<li class="yelpsnippet ui-state-disabled">Review: '.$response['snippet'];
    //figure out categories later. for now let's just pretend they're not here.
    //echo '</li><li class="yelpcat ui-state-disabled">'.$response['categories'];
    echo '</li><li class="readmore ui-state-disabled"><a href="'.$response['url'];
    echo '">Read more on Yelp.com</a></li></ul></li>';
    echo '<script type="text/javascript">
                  <!--
                  $("#" + "'.$id.'").children(".info").hide();
		   $("#" + "'.$id.'").each( function() {
		       $(this).click(function(event) {
			   if (this == event.target) $(this).children("ul").toggle();
                           }
                       );});
                   //-->
                  </script>';
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
  $snippet = $response->snippet_text;
  $category = "";  
  for ($i = 0; $i < count($response->categories); $i++) {
    $category = $category." ".$response->categories[$i];
  }    
  //name, rating, rating_img_url, url, categories, city, state
  $arr = array("id"=>$id, "name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "snippet"=>$snippet, "location"=>$location, "categories"=>$category, "url"=>$url);
  return ($arr);
        
}    
?>