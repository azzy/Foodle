<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
include_once("functions/newuser.php");
include_once("functions/newpoll.php");
include_once("functions/numVoted.php");
include_once("functions/genResults.php");
include("functions/results-getData.php");
include("PHPDatabaseStuff/sendResultsEmail.php");
/*
//debug
$userkey = 'A5547214-9C6D-E4A3-AF73-90C71394A9E5';
$type = 'cuisine';
$_POST = array();
$_POST['submit'] = 'Send';
$_POST['email1'] = 'evolutia2001@gmail.com';
$_POST['email2'] = 'alice.a.zheng@gmail.com';
$_POST['result0'] = 'Panera Bread';
$_POST['result1'] = "Ferry House";
$_POST['result2'] = "Chuck's Spring Street Cafe";
$_POST['result3'] = "";
$_POST['result4'] = "The Little Chef Pastry Shop";
*/
$userinfo = getUserInfo($userkey);
$pollid = $userinfo['pollid'];
$pollinfo = getPollInfo($pollid);
$pollEmails = getPollEmails($pollid);
if (array_key_exists('location', $pollinfo)) {
  $location = $pollinfo['location'];
} else { $location = "08544"; }
if (array_key_exists('submit', $_POST) and $_POST['submit'] == 'Send') {
  $num = mysql_numrows($pollEmails);
  $subject = "Results from Your Poll on Choosine";
  $body = "After looking at your preferences, we suggest that you go to one of these restaurants:\n";
  $from = "mailer@choosine.com";
  /*$i = 0;
  while ($i < $num) {
    if (mysql_result($result, $i, "usertype") == 'a') {
      $from = mysql_result($result, $i, "email");
      break;
    }
    ++$i;
    }*/
  foreach ($_POST as $field => $value) {
    if (preg_match("/result/", $field))
      $body = $body.$value."\n";
  }
  $body = $body."\n";
  foreach ($_POST as $field => $useremail) {
    if (preg_match("/email/", $field)) {
      $to = $useremail;
      sendEmail($to, $from, $subject, $body);
    }
  }
  header("Location: ./success.php");
  exit();
}
include_once("header.php");
if (!$pollid) {
  // TODO: return some logical error page instead
}
if ($type == 'restaurants') {
  $rankedResults = genResults($pollid, 5);
  }
else if ($type == 'cuisine') {
  $rankedResults = genResults($pollid, 3);
}
?>
<script type="text/javascript">
<!--
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "Uncheck all"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "Check all"; }
}
$('#formsubmit').click(function() {
$('#formtosubmit').submit();
});

// -->
</script>
<link rel="stylesheet" href="./css/portlets.css" type="text/css" />
</head>
<?php
echo '<body class="results '.$type.'">';
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="floatleft">
      <div class="text">
      <?php
        $voted = numVoted($pollid);
        $totalPeople = numVoters($pollid);
	echo "{$voted} People have voted. Results so far:"
      ?>
	</div>
	<div id="list-1">
      <div class="column">
      <?php 
        if ($type == 'cuisine')
	  $resultsNames = cuis_initList($rankedResults, $location);
	else if ($type == 'restaurants')
	  $resultsNames = rest_initList($rankedResults);
	else
	  echo "you have some sort of terrible error!!!!" // fix this
	    ?>
    </div><!-- end of .column -->
    </div>
    </div>
    <div class="floatright">
    <div class="text">Email results to:</div>
    <div id="list-2">
    <form name="emails" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="formtosubmit">
    <input type="checkbox" name="all" value="all"
	    onClick="this.value=check(this.form.list)" />Everybody<br />
	    <?php initResultsEmail($pollEmails); ?>
    <?php
	  foreach ($resultsNames as $i => $resultName)
	    echo '<input type="hidden" name="result'.$i.'" value="'.$resultName.'" />';?>
    </form>
    </div>
    <input type="submit" id="formsubmit" name="submit" value="Send" />
    </div>
    </div>
<script type="text/javascript">
$( ".portlet-header" ).click(function() {
    $( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
  });

    $(".portlet-content").hide();
</script>
<?php
include_once("footer.php");
?>