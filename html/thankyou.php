<?php
  include("header.php");
  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
  $userinfo = getUserInfo($userkey);
  $pollinfo = getPollInfo($userinfo['pollid']);
  $event_name = $pollinfo['pollname'];
  $event_id = $pollinfo['eventid'];
  echo '</head>
  <body class="review cuisine">';
?>

<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
    FB.init({
      appId      : '226055250820120',
	  status     : true, 
	  cookie     : true,
	  xfbml      : true,
          });
  };
(function(d){
  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
  js = d.createElement('script'); js.id = id; js.async = true;
  js.src = "//connect.facebook.net/en_US/all.js";
  d.getElementsByTagName('head')[0].appendChild(js);
}(document));
</script>

<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="text">Thank you for using Choosine! Please use the
	following URL to view your results.</div>
	<div class="text">
        <a href=<?php echo "./ranksort.php?type=$type&userkey=$userkey";?>>Vote for your poll!</a> <br/>
        <a href=<?php echo "./results.php?type=$type&userkey=$userkey"?>>Check your poll results!</a> <br />
  Create a Facebook event:<br/>
<?php


if ($event_id == null) {
  $event_id = createEvent($user_id, $event_name);
  setPollEventID($userinfo['pollid'], $event_id);
}
//else 
//    echo "already created an event";


function createEvent($user_id, $event_name) {
    include_once('facebook.php');
    $config = array(
		'appId' => '226055250820120',
		'secret' => '5b2f5db4d29d290a7472e41683180438',
		);
    // Initialize a Facebook instance from the PHP SDK
    $facebook = new Facebook($config);
    $user_id = $facebook->getUser();
    // event info
    $event_id = null;
    $nextWeek = time() + (7 * 24 * 60 * 60);
    //$event_privacy = "CLOSED";
    $event_privacy = 'SECRET';
    if($user_id) {
      try {
	$me = $facebook->api('/me', 'GET');
	// Create an event
	$ret_obj = $facebook->api('/me/events', 'POST', array(
							  'name' => $event_name,
							  'start_time' => $nextWeek,
							  'privacy_type' => $event_privacy
							  ));
	if(isset($ret_obj['id'])) { // Success
	  $event_id = $ret_obj['id'];
	  // echo 'Event ID: ' . $event_id;
	} else {
	  echo "Couldn't create event.";
	}
      }
      catch(FacebookApiException $e) {
	echo "exception!";
	// If the user is logged out, you can have a 
	// user ID even though the access token is invalid.
	// In this case, we'll get an exception, so we'll
	// just ask the user to login again here.
	$login_url = $facebook->getLoginUrl( array(
					       'scope' => 'create_event, rsvp_event'
					       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
	error_log($e->getType());
	error_log($e->getMessage());
      }   
    } 
    else {
      // No user, so print a link for the user to login
      $login_url = $facebook->getLoginUrl( array(
					     'scope' => 'create_event,rsvp_event'
					     )); 
      echo 'Please <a href="' . $login_url . '">login.</a>';
    }   
    return $event_id;
  }

?>

<?php
if ($event_id != null) {
  echo '<a href="http://www.facebook.com/events/'.$event_id.'" target="_blank">Go to your event and invite your friends!</a>';
}
?>
    </div>
    </div>
    <a href='<?php if ($userinfo["type"]=="a") echo "./email.php?type=$type&userkey=$userkey"; else echo "./ranksort.php?type=$type&userkey=$userkey";?>'>
    <img src="./images/left.png" id="nav-left" /></a>

  <?php include("footer.php"); ?>