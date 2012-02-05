<?php
    include("parse.php");
    include("authkeys.php");
    include("access.php");
    include("./lib/OAuth.php");
    function getData($cuisine, $limit, $loc) {
        echo("here-1");
        
        $unsigned_url = "http://api.yelp.com/v2/search?location=".$loc."&limit=".$limit."&category_filter=".$cuisine;
        // create URL and get Yelp response
        //$unsigned_url = "http://api.yelp.com/v2/business/".$business;
        $data = access($unsigned_url);
        $response = json_decode($data);
        echo($unsigned_url);
        
        //print_r($response);
        
        
        $num = count($response->businesses);
        $arrFinal = array("num"=>$num);
        echo("here-3 ".$num);
        
        for ($j = 0; $j < $num; $j++) {
            $name = name($response, $j);
            $rating = rating($response, $j);
            $ratingimg = ratingimg($response, $j);
            $url = $response->businesses[$j]->url;
            $location = ($response->businesses[$j]->location->city) . "," . ($response->businesses[$j]->location->state_code);
            $category = "";
            $catsize = count($response->businesses[$j]->categories);
            echo("<br>".$catsize."<br>");
            for ($i = 0; $i < $catsize; $i++) {
                $tag = $response->buseiness[j]->categories[$i];
                echo($tag);
                $category .= $tag." ";
            }
            echo($category);
            //name, rating, rating_img_url, url, categories, city, state
            $arr = array("name"=>$name, "rating"=>$rating, "ratingimg"=>$ratingimg, "location"=>$location, "categories"=>$category, "url"=>$url);
            $arrFinal[$j] = $arr;
            
        }
        
        return ($arrFinal);
        
        //return (array("name"=>"testname"));
       
        
    }
    
    $arrTest = getData("sandwiches", 2, "08544");
    print_r($arrTest);
    
?>