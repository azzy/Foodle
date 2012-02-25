<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
include_once("header.php");
  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  include_once("functions/numVoted.php");
  include_once("functions/genResults.php");
  include("functions/results-getData.php");
  
  $userinfo = getUserInfo($userkey);
  $pollid = $userinfo['pollid'];
  $pollinfo = getPollInfo($pollid);
  $location = $pollinfo['location'];
  
  //$pollid = 1;
  //$type = 'restaurants';
  //$location = "08544";
  if (!$pollid) {
    // TODO: return some logical error page instead
  }
  if ($type == 'restaurants') {
    $rankedResults = genResults($pollid, 5);
    //$rankedResults = array("chucks-spring-street-cafe-princeton","tiger-noodles-princeton", "sakura-express-princeton", "hunan-chinese-restaurant-princeton", "ajihei-princeton");
  }
  else {
    $rankedResults = genResults($pollid, 3);
    //print_r($rankedResults);
    //$rankedResults = array("japanese,sushi","chinese,dimsum","burgers");
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
        $response = array("num"=>5);
        if ($type == 'cuisine') {
            $res = getData($rankedResults[0], 2, $location);
            //print_r($res);            
            $response[0] = $res[0];
            $response[1] = $res[1];
            $res = getData($rankedResults[1], 2, $location);          
            $response[2] = $res[0];
            $response[3] = $res[1];
            $arr = getData($rankedResults[2], 1, $location);
            $response[4] = $arr[0];       
        }
        else{
            for ($i = 0; $i < count($rankedResults); $i++) {
                $response[$i] = getRestData($rankedResults[$i]);
            }
        
        }

        for ($i = 0; $i < 5; $i++) {        
            $res = $response[$i];
	    echo '<div class="portlet" id="'.$i.'">';
            echo "<div class='portlet-header'>".$res['name'].'</div>';
            echo("<div class='portlet-content'><ul>");
            echo("<li> Rating: ".$res['rating']."</li>");
            echo("<li> Categories: ".$res['categories']."</li>");
            echo("<li> Loc: ".$res['location']."</li>");
            echo("<li> Tel: ".$res['phone']."</li>");
            echo("<li><a href='".$res['url']."'>Yelp Profile</a></li>");
            echo("</ul>");
            echo("</div></div>"); ?>
<script type="text/javascript">
   <!-- $('.portlet #{$i}').ready(initiatePortletToggle({$i})); // -->
</script>
    <?php           }?>
    </div><!-- end of .column -->
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
