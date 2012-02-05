<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
  //$type = $_GET['type'];
  //$userkey = $_GET['userkey'];
  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  include_once("functions/numVoted.php");
  include_once("functions/genResults.php");
  include("functions/results-getData.php");
  /*
  $userinfo = getUserInfo($userkey);
  $pollid = $userinfo['pollid'];
  $pollinfo = getPollInfo($pollid);
  */
  $pollid = 1;
  $type = 'cuisine';
  $location = "08544";
  if (!$pollid) {
    // TODO: return some logical error page instead
  }
  if ($type == 'restaurants') {
    $rankedResults = genResults($pollid, 5);
  }
  else {
    //$rankedResults = genResults($pollid, 3);
    $rankedResults = array("japanese,sushi","chinese,dimsum","burgers");

    print_r($rankedResults);
    
    
    
    echo($location."<br>");
    //echo($rankedResults[0]."<br>");
    //print_r(getData($rankedResults[0], 2, $pollinfo['location']));
    // TODO: get restaurants for these cuisines
    
    
  }
?>
<!DOCTYLE html>
<html lang="en" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Choosine</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.0.6-development-only.js"></script>
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

$(document).ready(function() {
$('li.heading').children('ul').hide();
$('li.heading').each(
function(column) {
$(this).click(function(event) {
if (this == event.target) $(this).children('ul').toggle();
});
});
});
$('#formsubmit').click(function() {
$('#formtosubmit').submit();
});
// -->
</script>
<link href="http://fonts.googleapis.com/css?family=Coustard:400|Rokkitt:400" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./css/reset.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />
</head>
<body class="results cuisine">
<div id="banner"><a href="./index.html"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="floatleft">
      <div class="text">
      <?php
        $voted = numVoted($pollid);
        $totalPeople = numVoters($pollid);
	echo "{$voted}/{$totalPeople} People have voted. Results so far:"
      ?>
	</div>
	<div id="list-1">
      <ul id="results">
      <?php 
        for ($i = 0; $i < 2; $i++) {        
            $response = getData($rankedResults[$i], 2, $location);
            //print_r($response);
            for ($j = 0; $j < 2; $j++) {
                echo("<li class='heading'>".$response[$j]['name']);
                echo("<ul class='info'>");
                echo("<li> Rating: ".$response[$j]['rating']."</li>");
                echo("<li> Categories: ".$response[$j]['categories']."</li>");
                echo("<li> Loc: ".$response[$j]['location']."</li>");
                echo("<li> Tel: ".$response[$j]['phone']."</li>");
                echo("<li><a href='".$response[$j]['url']."'>Yelp Profile</a></li>");
                echo("</ul>");
                echo("</li>");
            }
        }
      
      
      
      ?>
     
    </div>
    </div>
    <div class="floatright">
    <div class="text">Email results to:</div>
    <div id="list-2">
    <form name="emails" action="" method="post" id="formtosubmit">
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
          <input type="checkbox" name="list" value="1" />First friend's
    e-mail<br />
    <input type="checkbox" name="list" value="2" />Second friend's
    e-mail<br />
    <input type="checkbox" name="list" value="3" />Third friend's
    e-mail<br />
    <input type="checkbox" name="list" value="4" />Fourth friend's
    e-mail<br />
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
</html>
