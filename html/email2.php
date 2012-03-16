<?php
/*
// debug
 $_POST = array();
 $_POST['submit'] = 'create poll';
 $type = $_POST['type'] = 'restaurants';
 $userkey = $_POST['userkey'] = '9F3EE83E-1011-193F-0902-A9FD2FC8C0FB';
 $_POST['email1'] = 'kanika1091@gmail.com';
*/
  // have to do this stuff before printing headers!!!
  if (array_key_exists('userkey', $_GET)) {
    $type = $_GET['type'];
    $userkey = $_GET['userkey'];
    //$userBody = $_GET['message'];
  }
if (!empty($_POST)) {
    $type = $_POST['type'];
    $userkey = $_POST['userkey'];
    $userSubj = $_POST['subject'];
    $userBody = $_POST['message'];
  }

  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  $userinfo = getUserInfo($userkey);
  $pollid = $userinfo['pollid'];

if (array_key_exists('submit', $_POST) and $_POST['submit'] == 'create poll') {
    // TODO: some validation
    $userkeys = array();
    
    foreach ($_POST as $field => $useremail) {
      if ($field !== 'submit' and $field !== 'userkey' and 
	  $field !== 'type' and $field !== 'message' and $field !== 'subject') {
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
<div class="text">You just finished nominating for your poll. We&apos;ll send an email to the guests above with a link to a page where they can vote on your poll. You may customize the email below:</div>
	<table><tr><td><label for="subject">Your Message Subject: </label></td>
      <td><input name="subject" value="via Choosine: Where should we go eat?" /></td></tr>
      <tr><td><label for="message">Your Message Body:</label></td>
      <td><textarea name="message" rows="3" cols="48">Write a message here to tell your guests to vote for the restaurant you&apos;ll go to for dinner.</textarea></td></tr></table>
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