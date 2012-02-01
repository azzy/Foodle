<html>

<head>
    <title>Testing!</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<body>

<?php
// --------------OAuth Stuff------------------------------------ 
// From http://non-diligent.com/articles/yelp-apiv2-php-example/
// Enter the path that the oauth library is in relation to the php file
require_once ('lib/OAuth.php');
//$unsigned_url = "http://api.yelp.com/v2/business/the-waterboy-sacramento/name";
//$unsigned_url = "http://api.yelp.com/v2/search?term=tacos&location=sf";
$unsigned_url = "http://api.yelp.com/v2/search?term=food&location=08544&limit=1&sort=2";
// Set your keys here
$consumer_key = "T7h8nAcJA5KvfPiroKWooQ";
$consumer_secret = "jLVWAmjRGAGQSKw9EJbpKS5GYzw";
$token = "ZQO9F_0HeL7XcH54Z66F4NLZ7pAUraN1";
$token_secret = "GZV-bIEVQKt0NkueKnh4tieKlY8";
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
// Handle Yelp response data
$response = json_decode($data);
// ------------------------------------------------------------
print_r($response);
echo "<br>";
echo "<br>";
print $response->businesses[0]->name;
echo "<br>";
echo "<br>";
/*
function name() {
    print $response->businesses[0]->name;
}

function a($n){ 
  b($n); 
  return ($n * $n); 
} 

function b(&$n){ 
  $n++; 
} 

echo a(5); //Outputs 36

echo "here<br>";
//name();
echo "<br>here";
echo "<br>";
echo "hmmmmmmm<br>";
*/

function a() {
    echo $response->businesses[0]->name;
    
}
echo a();

?>

    <h1>Yayyyyy</h1>
<?php
//print businesses(0)->name;
echo "<br>";
echo "<br>";
print "yayyy";
print_r($response);
/*
function a($n){ 
  b($n); 
  return ($n * $n); 
} 

function b(&$n){ 
  $n++; 
} 

echo a(5); //Outputs 36 
*/
?>
    
    
</body>
</html>