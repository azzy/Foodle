<?php
//-----------------------------------------------------------------------
// Author: Choosine
//-----------------------------------------------------------------------
  // TEST VALUES
  //$_GET = array();
  //$_GET['userkey'] = '1387ADEF-BE48-1171-935C-9CE37BBFEBC1';
  //$_GET['type'] = 'cuisine';
?>
<?php
// Get query string parameters; REQUIRE both 'type' and 'userkey'
if(array_key_exists('type', $_GET)) {
  $type = $_GET['type'];
} else if (array_key_exists('type', $_POST)) {
  $type = $_POST['type'];
} else { header("Location: error.php"); exit(); }

if (array_key_exists('userkey', $_GET)) {
  $userkey = $_GET['userkey'];
} else if (array_key_exists('userkey', $_POST)) {
  $userkey = $_POST['userkey'];
} else { header("Location: error.php"); exit(); }

// If this user is an admin, the parameter "nominate" determines whether to show
// them the nomination or the voting page.
$nominate = FALSE;
if (array_key_exists('nominate', $_GET)) {
  $nominate = $_GET['nominate']; // generally, it will be true or non-existent
} else if (array_key_exists('nominate', $_POST)) {
  $nominate = $_POST['nominate'];
}
include_once("functions/cuisines.php");
include_once("functions/initVoteNom.php");
include_once("functions/getUserVotes.php");
include_once("functions/newuser.php");
include_once("functions/newpoll.php");
// We need the user (and poll!) info; exit if bad userkey
$userinfo = getUserInfo($userkey);
if (!$userinfo) { header("Location: error.php"); exit(); }

$pollid = $userinfo['pollid'];
$pollinfo = getPollInfo($userinfo['pollid']);
if (array_key_exists('location', $pollinfo)) {
  $location = $pollinfo['location'];
} else { $location = "08544"; }

// Require a poll type in the query string parameter.
if ($type == "cuisine") {$print_type = "cuisines";}
else if ($type == "restaurants") { $print_type = $type; }
else { header("Location: error.php"); exit(); }

// Require a user to be an admin to see the nomination page. Ignore extraneous/erroneous "nominate" query string params.
if ($userinfo['usertype'] != 'a') {
  $nominate = FALSE;
}

include_once("header.php");

?>
<link rel="stylesheet" href="./css/portlets.css" type="text/css" />
</head>
<?php
echo '<body class="rank '.$type.'">';
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
  <div id="wrapper">
  <div id="container">
  <div id="content-area">
  <div class="text">
  <?php   
if ($nominate == true) {
  echo "To initiate your poll, drag ".$print_type." from the green list to the blue one for voters to choose from.";}
else {
  echo "To vote, rank the ".$print_type." by dragging from the green list to the blue one with your favorite ".$print_type." closer to the top.";}
?>
</div>

<div id="list-1">
  <div id="sortable1" class="column">
  <?php
  $arrOfIds = getPollChoices($pollid); // TODO: make sure this works when the poll is brand new. Form $choiceid => $yelpid
  if ($type == "restaurants") {
    if ($nominate == true) {
      $arrOfInfo = initRestNom($location);
      $arrOfChoices = initRestVote($arrOfIds);
      $arrRemaining = array_diff_key($arrOfInfo, $arrOfChoices);
      foreach($arrOfRemaining as $id => $info) {
	addItem($info);
      }
    }
    else { 
      $arrOfInfo = initRestVote($arrOfIds);
      $votes = getUserVotes($pollinfo['pollid'], $userinfo['userid']); // returns an array in form $choiceid => $rank
      asort($votes); // sort by rank
      // Remove from $arrOfInfo those choices that exist in $votes
      $arrRemaining = array_diff_key($arrOfInfo, $array_flip($array_intersect_key($arrOfIds, $votes)));
      foreach($arrRemaining as $id => $info) {
	addItem($info);
      }
    }
  }
  else if ($type == "cuisine") {
    if ($nominate == true) {
      $remainingIds = array_diff_key($idToCuis, array_flip($arrOfIds));
      foreach($remainingIds as $id=>$cuis)
	echo '<div class="portlet" id="'.$id.'">
              <div class="portlet-header">'.$cuis.'</div></div>';
    }
    else { 
      $votes = getUserVotes($pollinfo['pollid'], $userinfo['userid']); // returns an array in form $choiceid => $rank
      asort($votes); // sort by rank
      $remainingIds = array_diff_key($arrOfIds, $votes);
      foreach($remainingIds as $choiceid=>$id) {
	  $name=$idToCuis[$id];
	  echo '<div class="portlet" id="'.$id.'">
                <div class="portlet-header">'.$name.'</div></div>';
      }    
    }
  }

?>
</div>
</div>
<div id="list-2">
  <div id="sortable2" class="column">
  <div class="bin">Drop selections here</div>
<?php
  if ($type == "restaurants") {
    if ($nominate == true) {
      foreach($arrOfChoices as $id => $info) {
	addItem($info);
      }
    }
    else { 
      foreach($votes as $choiceid => $rank) {
	addItem($arrOfInfo[$arrOfIds[$choiceid]]);
      }
    }
  }
  else if ($type == "cuisine") {
    if ($nominate == true) {
      foreach($arrOfIds as $i=>$id) {
	// TODO: put these in the selected side
	$name=$idToCuis[$id];
	echo '<div class="portlet" id="'.$id.'">
              <div class="portlet-header">'.$name.'</div></div>';
      }
    }
    else { 
      foreach($votes as $choiceid=>$rank) {
	// TODO: put these in the selected side
	  $name=$idToCuis[$arrOfIds[$choiceid]];
	  echo '<div class="portlet" id="'.$arrOfIds[$choiceid].'">
                <div class="portlet-header">'.$name.'</div></div>';
      }
    }
  }
?>
  </div>
  </div>
    
  <?php
  if (($type == "restaurants")&&($nominate == true))
    {?>
     <div id="searchstuff">
     <div class="searchtext"><label>Search:</label>
     <input id="searchtxt" />
     <?php echo "<a href=\"javascript: search('$location')\"><img id=\"search\" src=\"./images/search.png\" /></a>"; ?>
     </div>
     </div>
     <div id="yelpdata">
     <a href="javascript: close()"><img src="./images/x.png" id="x" /></a>
     <?php echo "<a href=\"javascript: addYelpInfo('$location')\">"; ?>
     <img src="./images/add.png" id="add" /></a>
     <ul>
     <li class="yelpname"></li>
     <li class="yelprating"></li>
     <li class="yelpsnippet"></li>
     <li class="yelpcat"></li>
     <li class="readmore"></li>
     </ul>
     </div>
     
     </div><!-- end of content -->
     <?php
    } else { echo '</div><!-- end of content -->'; }?>
<?php	  	
if ($nominate===true) {
  echo "<a href='./initiate.php?type=".$type."&userkey=".$userkey."'><img src='./images/left.png' id='nav-left' /></a>";
}
?>
<a href='javascript: saveList()'><img src="./images/right.png" id="nav-right" /></a>
  <script type="text/javascript">
  <!--
  $( function() {
      // initialize search text
      $('#addnew').hide();
      $('#yelpdata').hide();
      initiatePortlets();
    });

//function to save the newly sorted list
function saveList() {

  var jsonList = $.extend({} ,$("#sortable2").sortable("toArray"));
  jsonList.userkey = '<?php echo $userkey ?>';
  jsonList.nominate = '<?php echo $nominate ?>'
    console.log(jsonList); // TODO: remove
  $.ajax({
    type: 'POST',
	traditional: true,
	data: jsonList,
	url: '/ajax/saveList.php',
	success: function(data) {
	window.location = "<?php if ($nominate==true) echo './email.php?type='.$type.'&userkey='.$userkey.'&nominate='.$nominate;
        else echo './thankyou.php?type='.$type.'&userkey='.$userkey; ?>";
      },
	error: function(error) {
	console.log("Error on posting data; try again?");
      }
    });
}
//-->
</script>
<?php
include_once("footer.php");
?>