<?php
    include("parse.php");
    include("authkeys.php");
    include("access.php");
    include("lib/OAuth.php");
    function getData($cuisine, $limit, $loc) {
        // create URL and get Yelp response
        $unsigned_url = "http://api.yelp.com/v2/search?location=".$loc."&limit=".$limit."&category_filter=".$cuisine;
        $data = access($unsigned_url);
        $response = json_decode($data);
        $num = count($response->businesses);
        $arrFinal = array("num"=>$num);
        
        for ($j = 0; $j < $num; $j++) {
            $name = name($response, $j);
            $rating = rating($response, $j);
            $ratingimg = ratingimg($response, $j);
            $url = $response->businesses[$j]->url;
            $location = ($response->businesses[$j]->location->city) . "," . ($response->businesses[$j]->location->state_code);
            $category = categories($response, $j);
            $phone = phone($response, $j);
            //echo("<br>".$category."<br>");
            //name, rating, rating_img_url, url, categories, city, state
            $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "categories"=>$category, "url"=>$url, "phone"=>$phone);
            $arrFinal[$j] = $arr;
            
        }
        
        return ($arrFinal);

    }
    
    //$arrTest = getData(breakfast_brunch, 2, "08544");
    //print_r($arrTest);
    
?>