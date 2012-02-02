<?php

require_once ('lib/OAuth.php');

//ChoosinetheSecond:
$consumer_key = "r_LK8yxWWjZLv-FmyGO3Vw";
$consumer_secret = "2l3wSMGLsYA0cQCgqnMSVUZpSus";
$token = "i5m-nLRW3o-18T2NTisIgGrzRPRpCWfZ";
$token_secret = "8YnLHst61xmdcAnIIXo3KYEtWBE";
//Choosine:
/*
$consumer_key = "T7h8nAcJA5KvfPiroKWooQ";
$consumer_secret = "jLVWAmjRGAGQSKw9EJbpKS5GYzw";
$token = "ZQO9F_0HeL7XcH54Z66F4NLZ7pAUraN1";
$token_secret = "GZV-bIEVQKt0NkueKnh4tieKlY8";
*/

function access($unsigned_url) {
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
return($data);
}

?>