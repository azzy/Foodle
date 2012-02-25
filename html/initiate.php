<?php
include("header.php");
include("validateRun.php");
require_once("functions/newuser.php");
require_once("functions/newpoll.php");
echo '</head><body class="initiate '.$type.'">';

// Placeholders, even if we have no actual info
$userinfo = array('name'=>'', 'email'=>'');
$pollinfo = array('location'=>'', 'name'=>'');
// If we are supposed to validate the form data here, i.e. this is an attempted submission
if($_POST)
  {
    $errorMessage = "";

    if ($_POST['email']) {
      $isValid = isValid($_POST['email'], $_POST['location']);
    } else {
      $isValid = FALSE;
    }

    if($isValid) {
      //echo "AAAAAAAAAARRRRRGHHHHHH";
      // If the form data is valid, save it to the database.
      // Is this a new poll?
      if ($pollid || $userkey) 
      {
	// TODO: Update existing info instead of creating a new poll
      }
      else{
	$pollid = newPoll($_POST['dinner'], $_POST['location'], $type);
	// create an admin user for the poll
	$userkey = newUser($pollid, 'a', $_POST['email'], $_POST['name']);
      }
    }

    if ($isValid) {
      //  echo "true";
    } else {
      // echo "false";
      $errorMessage .= "invalid";
    }
    
    if(empty($errorMessage)) 
      {
	header("Location: ranksort.php?type=".$type."&userkey=".$userkey."&nominate=true");
      }
    else {
      echo("<p>There was an error with your form:</p>\n");
      echo("<ul>" . $errorMessage . "</ul>\n");
    }
  }
// If we are trying to load an existing user's info, i.e. to edit it
else if ($userkey) {
  $userinfo = getUserInfo($userkey);
  $pollinfo = getPollInfo($userinfo['pollid']);
}
?>

<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
  <div id="wrapper">
  <div id="container">
  <div id="content-area">
  <div class="form">
  <form name="input" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF'])."?type=".$type;?>">
  <table>
  <tr>
  <td><label for="dinner">Dinner Name:</label></td>
  <td><input type="text" id="dinner" name="dinner" placeholder="" value="<?php echo $pollinfo['name'];?>"/></td>
  </tr><tr>
  <td><label for="name">Your Name:</label></td>
  <td><input type="text" id="name" name="name" placeholder="" value="<?php echo $userinfo['name'];?>"/></td>
  </tr><tr>
  <td><label for="email">Your Email:</label></td>
  <td><input type="text" id="email" name="email" placeholder="" value="<?php echo $userinfo['email'];?>"/></td>
  </tr><tr>
  <td><label for="location">Your Location:</label></td>
  <td><input type="text" id="location" name="location" placeholder="City, State or ZIP" value="<?php echo $pollinfo['location'];?>" / ></td>
  </tr>
  </table>
  <input type="hidden" name="type" value="<?php echo $type;?>">
  </form>
  </div>
  </div><!-- end content-area -->
  <a href='./index.php'><img src="./images/left.png" id="nav-left" /></a>
  <script type="text/javascript">
  function submitform() {
	  document.input.submit();
	}
</script>
<a href='javascript: submitform()'><img src="./images/right.png" id="nav-right" /></a>
  <?php
  require_once "footer.php";
?>
