<?php
  // have to do this stuff before printing headers!!!
  if (array_key_exists('userkey', $_GET)) {
    $type = $_GET['type'];
    $userkey = $_GET['userkey'];
    //$userBody = $_GET['message'];
  } else {
    $type = $_POST['type'];
    $userkey = $_POST['userkey'];
  }
$userSubj = $_GET['subject'];
$userBody = $_GET['message'];
/*
// debug
 $_POST = array();
 $_POST['submit'] = 'create poll';
 $type = $_POST['type'] = 'restaurants';
 $userkey = $_POST['userkey'] = '9F3EE83E-1011-193F-0902-A9FD2FC8C0FB';
 $_POST['email1'] = 'kanika1091@gmail.com';
*/
  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  $userinfo = getUserInfo($userkey);
  $pollid = $userinfo['pollid'];

if (array_key_exists('submit', $_POST) and $_POST['submit'] == 'create poll') {
    // TODO: some validation
    $userkeys = array();
    
    foreach ($_POST as $field => $useremail) {
      if ($field !== 'submit' and $field !== 'userkey' and $field !== 'type' and $useremail) {
        $userkeys[] = newUser($pollid, 'v', $useremail);
      }
    }
    include_once('PHPDatabaseStuff/sendUsersEmail2.php');
    sendPollEmail($pollid, $type, $userSubj, $userBody);
    header("Location: ./thankyou.php?type={$type}&userkey={$userkey}");
    exit();
  }
include("header.php");
echo '</head><body class="emails '.$type.'">';

?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
    <div class="text">Your Guests&apos; Emails:</div>
    <form name="input" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <div class="form" id="emails-form">
      <input name="email1"/>
      <input name="email2"/>
      <input name="email3"/>
    </div>
    <input type="hidden" name="userkey" value="<?php echo $userkey; ?>" />
    <input type="hidden" name="type" value="<?php echo $type; ?>" />
    <a href="javascript:add_field()"><div id="addnew">
      <img src="./images/add.png" />Add another person</div></a>
      <!-- <a href='<?php ?>'> --><input type="submit" value="create poll" name="submit" class="submit" /> <!--</a>-->
      <div class="text">Your Message Subject: </div>
      <textarea name="subject" rows="1" cols="48"></textarea>
      <div class="text">Your Message Body:</div>
      <textarea name="message" rows="3" cols="48">Write a message here to tell your guests to vote for the restaurant you&apos;ll go to for dinner.</textarea>
	</form>
	
	<div id="template" style="display:none">
	  <input />
	</div>
    </div>
    
    <a href='<?php echo "ranksort.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>   
 <?php include('footer.php'); ?>


<script type="text/javascript">
<!--//Add Field to emails-form.
function add_field()
{
    var div1 = document.createElement('div');
    div1.innerHTML = document.getElementById('template').innerHTML;
    document.getElementById('emails-form').appendChild(div1);
}
//-->
</script>