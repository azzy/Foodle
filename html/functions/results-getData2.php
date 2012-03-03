<?php
include_once("authkeys.php");
include_once("access.php");
include_once("lib/OAuth.php");

// calls cuis_initSome to print the appropriate number of restaurants of each cuisine to our list.
function cuis_initList($rankedResults, $location) {
  // print two restaurants in first category
  cuis_initSome($rankedResults[0], 2, $location);
  // print two restaurants in second category
  cuis_initSome($rankedResults[1], 2, $location);          
  // print one restaurant in third category
  cuis_initSome($rankedResults[2], 1, $location);
}

// calls rest_initOne to print the appropriate length list of ranked restaurants to our list.
function rest_initList($rankedResults) {
  $num = count($rankedResults);
  for ($i = 0; $i < $num; $i++)
    rest_initOne($rankedResults[$i]);
}

// prints the formatted info of some restaurants depending on cuisine, limit and location parameters
function cuis_initSome($cuisine, $limit, $loc) {
  $unsigned_url = "http://api.yelp.com/v2/search?location=".$loc."&limit=".$limit."&category_filter=".$cuisine;
  $data = access($unsigned_url);
  $response = json_decode($data);

  foreach ($response->businesses as $i=>$business) {
    $info = getRestInfo($business);
    addItem($info);
  }
}
    
// prints the formatted restaurant data given a yelp business id
function rest_initOne($business) {
  $unsigned_url = "http://api.yelp.com/v2/business/".$business;
  $data = access($unsigned_url);
  $response = json_decode($data);
        
  $info = getRestInfo($response);
  addItem($info);
}

// return array of restaurant data given a yelp business response
function getRestInfo($business) {
  $name = $business->name;
  $rating = $business->rating;
  $ratingimg = $business->rating_img_url;
  $url = $business->url;
  $location = ($business->location->city).", ".($business->location->state_code);
  $phone = $business->phone;
  $length = count($business->categories);
  if ($length > 0)
    $category = $business->categories[0][0];
  else
    $category = "";  
  for ($i = 1; $i < count($business->categories); $i++) {
    $category = $category.", ".$business->categories[$i][0];
  }    
  $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg,
	       "location"=>$location, "phone"=>$phone,
	       "categories"=>$category, "url"=>$url);
  return($arr);
}

// print the given info in the appropriate format
function addItem($info) {
  $name = $info['name'];
  $phone = $info['phone'];
  echo '<div class="portlet" id="'.$phone.'">
<div class="portlet-header">'.$name.'</div>
<div class="portlet-content"><ul>
<li class="yelprating"><img src="'.$info['ratingimg'].'" /></li>
<li class="yelpcat">Categories: '.$info['categories'].'" /></li>
<li class="yelploc">Location: '.$info['location'].'" /></li>
<li class="yelptel">Phone: '.$phone.'" /></li>
<li class="readmore"><a href="'.$info['url'].'">Read more on Yelp.com</a></li>
</ul></div></div>';

  echo '<script type="text/javascript">
   <!-- $(".portlet #'.$phone.'").ready(initiatePortletToggle('.$phone.')); // -->
   </script>';
}
    
?>