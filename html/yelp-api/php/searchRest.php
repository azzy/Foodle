<?php
/***************************************
Meant for the following jquery/html code

HTML:
Search for name of restaurant: <input type="text" name="search" /> <br/>
 <input type="submit" value="Submit" /><br/>
 
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
function search() {
    searchTxt = form.elements["search"];
    $.get("searchRest.php");
    return false;
}
</script>

<a href="#" onclick="doSomething();">Click Me!</a>


mouse up or click???

$(‘.searchbutton’).mouseup(function() {
    var searchTxt = $('.form.name?');
    var data = $.get("searchRest.php", searchTxt);
    $('somewhereMakeThisDisplayVisible').toggle(); 
    $('#placetoputYelpData').html(data);
    $('PlusSignButtonVisible').toggle(); 
    $('MakeXButtonVisible').toggle(); 
});

$('PlusSignButtonVisible').click(function() {
    // add new list item
}); 

$('MakeXButtonVisible').click(function() {
    $('somewhereMakeThisDisplayInVisible').toggle(); 
    $('PlusSignButtonInVisible').toggle(); 
    $('MakeXButtonInVisible').toggle(); 
    $('MakeSearchButtonVisible').toggle();  
}); 


need to be able to add new item to the list


***************************************/


require_once ('lib/OAuth.php');
include("access.php");
include("parse.php");
include("formmatch.php");

if (empty($_POST['sendValue'])) {
    echo json_encode(array("returnValueName"=>"This is name from PHP : ", "returnValueId"=>"This is id from PHP : "));
}
else {
    $name = str_replace(" ", "+", $_POST['sendValue']);
    $unsigned_url = "http://api.yelp.com/v2/search?term=".$name."&location=08544&limit=2&category_filter=food,restaurants";
    $data = access($unsigned_url);
    $response = json_decode($data);
    echo json_encode(array("returnValueName"=>"This is name from PHP : ".name($response, 0), "returnValueId"=>"This is id from PHP : ".id($response, 0)));
}


?>
