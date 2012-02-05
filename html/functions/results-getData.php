<?php
    include("parse.php");
    function getData($cuisine, $limit, $loc) {
        echo("here-1");
        $unsigned_url = "http://api.yelp.com/v2/search?location=".$loc."&limit=".$limit."&category_filter=".$cuisine;
        // create URL and get Yelp response
        //$unsigned_url = "http://api.yelp.com/v2/business/".$business;
        $data = access($unsigned_url);
        $response = json_decode($data);
        echo("here-2");
        //print_r($response);
        $num = count($response->businesses);
        $arrFinal = array("num" : $num);
        echo("here-3 ".$num);
        for ($j = 0; $j < $num; $j++) {
            $name = name($response, $j);
            $rating = rating($response, $j);
            $ratingimg = ratingimg($response, $j);
            //$url = $response->url;
            //$location = ($response->location->city) . "," . ($response->location->state_code);
            $category = "";  
            for ($i = 0; $i < count($response->categories); $i++) {
                $category = $category.$response->categories[$i];
            }    
            //name, rating, rating_img_url, url, categories, city, state
            $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "categories"=>$category, "url"=>$url);
            $arrFinal[$j] = $arr;
        }
        return ($arrFinal);
        
    }
    
    $arrTest = getData("sandwiches", 2, "08544");
    print_r($arrTest);
?>