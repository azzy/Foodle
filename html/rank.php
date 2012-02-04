<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
  include("header.php");
?>
</head>
<?php
   echo '<body class="rank '.$type.'">';
  if ($_POST != null) {
    include("initiate_validate.php");
    if ($isValid) {
      echo "validated the form! Good to go. user is ".$userkey;
    }
    else {
      echo "Invalid form. :( We should reject it, and don't return any more html!";
      // TODO exit here somehow? return previous page (form) or do that in the initiate_validate file?
    }
  }
  else {
    echo " Didn't get to this page from the form. TODO: populate fields from database if possible, otherwise display an error";
  }
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="text">
	Rank the cuisines in the green box in order of preference by
      dragging into the blue box. Select as many as you care about,
      and put your very favorite ones on top!
	</div>

    <div id="list-1">
      <ul id="sortable1" class="connectedSortable">
<?php
  if ($type == "restaurants") {
    for ($i = 1; $i <= 10; $i++) {
      echo '<li class="draggable heading" id="switch-to-uniqueid'.$i.'">';
      echo 'Restaurant Name retrieved from YELP';
      echo '<ul class="info"><li>Information retrieved from YELP</li></ul></li>';
    }
  }
  else if ($type == "cuisine") {
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
  else echo  " Didn't get to this page properly. TODO: display error page";

?>
    </ul>
    </div>
    <div id="list-2">
      <ul id="sortable2" class="connectedSortable">
	<li class="bin">Drop selections here</li>
   </ul>
    </div>
    
    <div id="searchstuff">
      <div class="searchtext"><label>Search:</label><input id="searchtxt" cols="20" rows="1" /></div>
      <a href="javascript:search();"><img id="search" src="./images/search.png" /></a>
    
    <div id="addnew"><img src="./images/add.png" />Add To List</div>

    </div>
    <a href='<?php echo "./initiate.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>
    <a href='<?php echo "./email.php?type=$type&userkey=$userkey"; ?>'><img src="./images/right.png" id="nav-right" onClick="saveList();"/></a>
    
<?php
  include("footer.php");
?>
<script type="text/javascript">
<!--
$( function() {
$('#sortable1, #sortable2').sortable( {
cursor: 'move',
connectWith: ".connectedSortable",
dropOnEmpty: true
});
$("#sortable1, #sortable2").disableSelection();
});

function saveList() {
$("#sortable2").sortable("serialize");
}

$(document).ready(function() {
$('li.heading').children('.info').hide();
$('li.heading').each(
function(column) {
$(this).click(function(event) {
if (this == event.target) $(this).children('ul').toggle();
});
});
});

//Initialize the page (This function runs on pageload)
$(function () {
    $('.sec').toggle();
});

// when doc is ready, if search button is clicked retrieve yelp info

function search () {
    // toggle on secondary buttons, toggle off main search button
    $('#addnew').toggle();
    //$('#search').toggle();
    // retrieve the search text
    var searchTxt =  $("#searchstuff").find("input").val();
    // get yelp data on the search text
    getYelp(searchTxt);
}
//-->
</script>