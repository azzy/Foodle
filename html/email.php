<?php
  include("header.php");
  if (array_key_exists('userkey', $_GET)) {
    $type = $_GET['type'];
    $userkey = $_GET['userkey'];
  } else {
    $type = $_POST['type'];
    $userkey = $_POST['userkey'];
  }
  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  $userinfo = getUserInfo($userkey);
  $pollid = $userinfo['pollid'];
  echo '</head><body class="emails '.$type.'">';
?>
<?php
if (array_key_exists('submit', $_POST) and $_POST['submit'] == 'create poll') {
    // TODO: some validation
    $userkeys = array();
    
    foreach ($_POST as $field => $useremail) {
      if ($field !== 'submit' and $field !== 'userkey' and $field !== 'type') {
        $userkeys[] = newUser($pollid, 'v', $useremail);
      }
    }
    echo var_dump($_POST);
    //header("Location: ./thankyou.php?type={$type}&userkey={$userkey}");
    exit();
  }
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
    <div class="text">Your Guests&apos; Emails:</div>
    <form name="input" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <div class="form" id="emails-form">
      <input />
      <input />
      <input />
    </div>
    <input type="hidden" name="userkey" value="$userkey" />
    <input type="hidden" name="type" value="$type" />
    <a href="javascript:add_field()"><div id="addnew">
      <img src="./images/add.png" />Add another person</div></a>
      <!-- <a href='<?php ?>'> --><input type="submit" value="create poll" name="submit" class="submit" /> <!--</a>-->
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