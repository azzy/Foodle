<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
include_once("header.php");
include_once("functions/newuser.php");
include_once("functions/newpoll.php");
include_once("functions/numVoted.php");
include_once("functions/genResults.php");
include("functions/results-getData.php");
$userinfo = getUserInfo($userkey);
$pollid = $userinfo['pollid'];
$pollinfo = getPollInfo($pollid);
if (array_key_exists('location', $pollinfo)) {
  $location = $pollinfo['location'];
} else { $location = "08544"; }

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
	  cuis_initList($rankedResults, $location);
	else if ($type == 'restaurants')
	  rest_initList($rankedResults);
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
    <input type="checkbox" name="list" value="1" />First friend's
    e-mail<br />
    <input type="checkbox" name="list" value="2" />Second friend's
    e-mail<br />
    <input type="checkbox" name="list" value="3" />Third friend's
    e-mail<br />
    <input type="checkbox" name="list" value="4" />Fourth friend's
    e-mail<br />
    </form>
    </div>
    <a href="success.html"><div id="formsubmit">Send</div></a>
    </div>
    </div>
    
  <div class="clear"></div>
  <div id="footer">We know you're really excited to use Choosine,
  but it doesn't exist yet! Sorry :(</div>
  </div>
  </div> <!-- end wrapper -->
</body>
<script type="text/javascript">
$( ".portlet-header" ).click(function() {
    $( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
  });

    $(".portlet-content").hide();
</script>
</html>
