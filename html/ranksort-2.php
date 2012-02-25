<?php
//-----------------------------------------------------------------------
// Author: Choosine
//-----------------------------------------------------------------------
?>
<?php
include_once("header.php");
include_once("functions/newuser.php");
include_once("functions/newpoll.php");
$nominate = FALSE;
if (array_key_exists('nominate', $_GET)) {
  $nominate = $_GET['nominate']; // generally, it will be true or non-existent
  
}
$userinfo = getUserInfo($userkey);
$pollid = $userinfo['pollid'];
$pollinfo = getPollInfo($userinfo['pollid']);
if (array_key_exists('location', $pollinfo)) {
  $location = $pollinfo['location'];
} else { $location = "08544"; }
?>
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
  <ul id="sortable1" class="connectedSortable">
  <?php
  if ($type == "restaurants") {
    if ($nominate == true) {
      echo '<script type="text/javascript">
    <!--
	initiateRestNom("'.$location.'");
    //-->
    </script>';
    }
    else { 
      $arrOfIds = getPollChoices($pollid);
      include("functions/initiateRestVote.php");
      addItems($arrOfIds);
    }
  }
  else if ($type == "cuisine") {
    if ($nominate == true) {
      $cuisines = array('American','Desserts & Ice Cream','Breakfast & Brunch',
			'Burgers','Cafes','Chinese','Delis & Sandwiches','Diners',
			'French','Greek','Indian & Pakistani','Italian','Japanese',
			'Latin American','Mexican','Middle Eastern','Pizza','Seafood',
			'Southern & Soul Food','South-East Asian','Vegan & Vegetarian');
      $ids = array('tradamerican,newamerican','bakeries,desserts,icecream',
		   'breakfast_brunch','burgers','cafes,coffee,tea','chinese,dimsum',
		   'delis,sandwiches','diners','french','greek','indpak,pakistan',
		   'italian','japanese,sushi','latin,peruvian','mexican','mideastern',
		   'pizza','seafood','soulfood,southern',
		   'thai,malaysian,singaporean,vietnamese,indonesian','vegan,vegetarian');
      $length = count($cuisines);
      for ($i = 1; $i <= $length; $i++) {
	echo '<li class="draggable heading" id="'.$ids[$i].'">'.$cuisines[$i].'</li>';
      }
    }
    else { 
      $arrOfIds = getPollChoices($pollid);
      var_dump($arrOfIds);
      include("functions/initiateCuisVote.php");
      addItems($arrOfIds,$idToCuis);
    }
  }
  else echo  " Didn't get to this page properly. TODO: display error page";

?>
</ul>
</div>
<div id="list-2">
  <ul id="sortable2" class="connectedSortable">
  <li class="bin ui-state-disabled">Drop selections here</li>
  </ul>
  </div>
    
  <?php
  if (($type == "restaurants")&&($nominate == true)) {?>
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
  } else { echo '</div><!-- end of content -->'; }
if ($nominate == true) {
  echo "<a href='./initiate.php?type=".$type."&userkey=".$userkey."'><img src='./images/left.png' id='nav-left' /></a>";
} ?>
<a href='javascript: saveList()'><img src="./images/right.png" id="nav-right" /></a>
  <script type="text/javascript">
  <!--
  $( function() {
      // initialize search text
      $('#addnew').hide();
      $('#yelpdata').hide();
      initiateSortable();
      //initiateExpandCollapse();
    });

//function to save the newly sorted list
function saveList() {

  var jsonList = $.extend({} ,$("#sortable2").sortable("toArray"));
  jsonList.userkey = '<?php echo $userkey ?>';
  jsonList.nominate = true;
    console.log(jsonList); // TODO: remove
  $.ajax({
    type: 'POST',
	traditional: true,
	data: jsonList,
	url: '/ajax/saveList.php',
	success: function(data) {
	window.location = "<?php echo './email.php?type='.$type.'&userkey='.$userkey.'&nominate='.$nominate; ?>";
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