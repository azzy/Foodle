<?php
//-----------------------------------------------------------------------
// Author: Choosine
//-----------------------------------------------------------------------
?>
<?php
if(array_key_exists('type', $_GET)){
  $type = $_GET['type'];
} else {
  $type = $_POST['type'];
}
if(array_key_exists('userkey', $_GET)){
  $type = $_GET['userkey'];
} else {
  $type = $_POST['userkey'];
}
$nominate = FALSE;
// TODO: Verify that this user is the actual poll admin before showing them the nomination page!
// ( the parameter still helps if they ARE the admin
if (array_key_exists('nominate', $_GET)) {
  $nominate = $_GET['nominate']; // generally, it will be true or non-existent
} else if (array_key_exists('nominate', $_POST)) {
  $nominate = $_POST['nominate'];
}
include_once("header.php");
include_once("functions/cuisines.php");
include_once("functions/initVoteNom.php");
include_once("functions/newuser.php");
include_once("functions/newpoll.php");
$userinfo = getUserInfo($userkey);
$pollid = $userinfo['pollid'];
$pollinfo = getPollInfo($userinfo['pollid']);
if (array_key_exists('location', $pollinfo)) {
  $location = $pollinfo['location'];
} else { $location = "08544"; }
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
  if ($type == "cuisine") {$print_type = "cuisines";}
  else if ($type == "restaurants") { $print_type = $type; }
if ($nominate == true) {
  echo "To initiate your poll, drag ".$print_type." from the green list to the blue one for voters to choose from.";}
else {
  echo "To vote, rank the ".$print_type." by dragging from the green list to the blue one with your favorite ".$print_type." closer to the top.";}
?>
</div>

<div id="list-1">
  <div id="sortable1" class="column">
  <?php
  if ($type == "restaurants") {
    if ($nominate == true)
      initRestNom($location);
    else { 
      $arrOfIds = getPollChoices($pollid);
      var_dump($arrOfIds);
      initRestVote($arrOfIds);
    }
  }
  else if ($type == "cuisine") {
    if ($nominate == true) {
      foreach($idToCuis as $id=>$cuis)
	echo '<div class="portlet" id="'.$id.'">
              <div class="portlet-header">'.$cuis.'</div></div>';
    }
    else { 
      $arrOfIds = getPollChoices($pollid);
      foreach($arrOfIds as $i=>$id) {
	  $name=$idToCuis[$id];
	  echo '<div class="portlet" id="'.$id.'">
                <div class="portlet-header">'.$name.'</div></div>';
        }    }
  }
  else echo  " Didn't get to this page properly. TODO: display error page";

?>
</div>
</div>
<div id="list-2">
  <div id="sortable2" class="column">
  <div class="bin">Drop selections here</div>
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