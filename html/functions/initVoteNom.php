<?php
require_once ('lib/OAuth.php');
include_once("access.php");
//include_once("parse.php");
include_once("foodledbinfo.php");
include_once("newpoll.php");
include_once("newuser.php");
include_once("cuisines.php");
//$arrOfIds = array("the-bent-spoon-princeton", "witherspoon-grill-princeton", "nassau-sushi-princeton");

function addCuisines($arrOfIds) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $name=$idToCuis[$arrOfIds[$i]];
            echo '<div class="portlet-header" id="'.$i.'">'.$name.'</div>';
        }
    }
  
function initRestVote($arrOfIds) {
  $num = count($arrOfIds);
  for ($i = 0; $i < $num; $i++) {
    // create URL and get Yelp response
    $unsigned_url = "http://api.yelp.com/v2/business/".$business;
    $data = access($unsigned_url);
    $response = json_decode($data);
    $info = getRestInfo($response);
    addItem($info);
  }
}

function initRestNom($loc) {
  $num = 10; // limit to 10 results

  // create URL and get Yelp response
  $unsigned_url = "http://api.yelp.com/v2/search?&location=".$loc
    ."&limit=".$num."&category_filter=restaurants";
  $data = access($unsigned_url);
  $response = json_decode($data);

  // fetch information and add to page
  $num = count($response->businesses);
  for ($i = 0; $i < $num; $i++) {
    $info = getRestInfo($response->businesses[$i]);
    addItem($info);
  }
}
function addItem($info) {
    $id = $info["id"];
    $name = $info["name"];
    echo '<div class="portlet" id="'.$id.'">';
    echo '<div class="portlet-header">'.$name.'</div>';
    echo '<div class="portlet-content"><ul>
<li class="yelprating"><img src="'.$info['ratingimg'];
    echo '" /></li><li class="yelpsnippet">Review: '.$info['snippet'];
    echo '</li><li class="yelpcat">Categories: '.$info['categories'];
    echo '</li><li class="readmore"><a href="'.$info['url'];
    echo '">Read more on Yelp.com</a></li></ul></div></div>';
    /* echo '<script type="text/javascript">
                  <!--
                  $("#" + "'.$id.'").children(".info").hide();
		   $("#" + "'.$id.'").each( function() {
		       $(this).click(function(event) {
			   if (this == event.target) $(this).children("ul").toggle();
                           }
                       );});
                   //-->
                  </script>';*/
}

function getRestInfo($response) {
  $id = $response->id;
  $name = $response->name;
  $rating = $response->rating;
  $ratingimg = $response->rating_img_url;
  $url = $response->url;
  $location = ($response->location->city) . ", " . ($response->location->state_code);
  $snippet = $response->snippet_text;
 
  $length = count($response->categories);
  if ($length > 0)
    $category = $response->categories[0][0];
  else 
    $category = "";  
  for ($i = 1; $i < count($response->categories); $i++) {
    $category = $category.", ".$response->categories[$i][0];
  }    

  //name, rating, rating_img_url, url, categories, city, state
  $arr = array("id"=>$id, "name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "snippet"=>$snippet, "location"=>$location, "categories"=>$category, "url"=>$url);
  return ($arr);
}
?>