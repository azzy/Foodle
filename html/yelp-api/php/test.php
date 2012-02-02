<html>

<head>
    <title>Testing!</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>

<h1>Search Parameters</h1>

<form method="post" action="<?php echo $PHP_SELF;?>">
 Search for: <input type="text" name="tag1" /> <br/>
 Location: <input type="text" name="loc" /> <br/>
 Number of Busnesses to Retun: <input type="text" name="numBus" /><br/> 
 <input type="submit" value="Submit" /><br/>
</form>

<?php
$tag = $_POST["tag1"];
$numBus=$_POST["numBus"];
$location=$_POST["loc"];
echo "<p> You searched for " . $tag . "</p></br>";;
$tag = str_replace(" ", "", $tag);
$location=str_replace(" ", "", $location);
$name = "Witherspoon-grill";

// --------------OAuth Stuff------------------------------------ 
// From http://non-diligent.com/articles/yelp-apiv2-php-example/
// Enter the path that the oauth library is in relation to the php file
require_once ('lib/OAuth.php');
include("authkeys.php");
echo $consumer_key;

echo $consumer_key;
echo "<br/>";
echo $consumer_secret;
echo "<br/>";
echo $token;
echo "<br/>";
echo $token_secret;

echo "<br/>";
//cut paste = ctrl+space ctrl+w ctrl+y
// copy = esc w 
//$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento/name";
//$unsigned_url = "http://api.yelp.com/v2/search?term=tacos&location=sf";
//$unsigned_url = "http://api.yelp.com/v2/search?term=food,".$tag."&location=".$location."&limit=".$numBus."&sort=2&name=".$name."";
$unsigned_url = "http://api.yelp.com/v2/search?term=food&location=08544&name=witherspoon_grill&category=food,restaurant";
echo $unsigned_url . "</br>";


echo $location . "<br/>";
// Set your keys here
// Token object built using the OAuth library
$token = new OAuthToken($token, $token_secret);
// Consumer object built using the OAuth library
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
// Yelp uses HMAC SHA1 encoding
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
// Build OAuth Request using the OAuth PHP library. Uses the consumer and token object created above.
$oauthrequest = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $unsigned_url);
// Sign the request
$oauthrequest->sign_request($signature_method, $consumer, $token);
// Get the signed URL
$signed_url = $oauthrequest->to_url();
// Send Yelp API Call
$ch = curl_init($signed_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch); // Yelp response
curl_close($ch);

//$data = access($unsigned_url);
// Handle Yelp response data
$response = json_decode($data);
// ------------------------------------------------------------
print_r($response);
echo "<br>";

function name($response, $ind) {
    return "" . $response->businesses[$ind]->name;
}
function rating($response, $ind){
  return "" .  $response->businesses[$ind]->rating;
}
function location($response, $ind){
  return "" .  $response->businesses[$ind]->location->city;
}
function snippet($response, $ind){
  return "" .  $response->businesses[$ind]->snippet_text;
}
function ratingimg($response, $ind) {
    return "" . $response->businesses[$ind]->rating_img_url;
}
function snippetimg($response, $ind){
  return "" .  $response->businesses[$ind]->snippet_image_url;
}
function tags($response, $ind){
  return "" .  $response->businesses[$ind]->categories[0][0];
}
function ratingimgsm($response, $ind){
  return "" .  $response->businesses[$ind]->rating_img_url_small;
}

echo "<br>";
echo "<br>";
?>

    <h1>Search Results</h1>
    <p> Put the (parsed) search results here</p>

<?php
//print businesses(0)->name;
echo "<br> Printing out various info here: <br> ";

echo name($response, 0);
echo "<br> Rating:  ";
echo rating($response, 0);
echo "<br> City:  ";
echo location($response, 0);
echo "<br> Snippet Review:  ";
echo snippet($response, 0);
echo "<br><img src='" . ratingimg($response, 0)  . "'>Rating Img normal</img><br>";
echo "<img src='" . snippetimg($response, 0)  . "'>Snippet</img><br>";
echo "<img src='" . ratingimgsm($response, 0)  . "'>Small Rating</img><br>";
echo tags($response, 0);
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
print_r($response);
?>

<p>and you can put more text hereeee yay?</p>

</body>
</html>