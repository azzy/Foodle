<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
  
  $nominate = FALSE;
  if (array_key_exists('nominate', $_GET)) {
    $nominate = $_GET['nominate']; // generally, it will be true or non-existent
  }
  include_once("header.php");
  include_once("functions/newuser.php");
  include_once("functions/newpoll.php");
  $userinfo = getUserInfo($userkey);
  $pollinfo = getPollInfo($userinfo['pollid']);
  $location = $pollinfo['location'];
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
	<li class="bin ui-state-disabled">Drop selections here</li>
   </ul>
    </div>
    
<?php
  if ($type == "restaurants") {?>
    <div id="searchstuff">
      <div class="searchtext"><label>Search:</label>
      <input id="searchtxt" />
    <a href="javascript: search()"><img id="search" src="./images/search.png" /></a>
    </div>
      <a href="javascript: addYelpInfo()"><div id="addnew">
    <!--<img src="./images/add.png" />Add To List</div></a>-->
    </div>
</div>
<div id="yelpdata">
<a href="javascript: close()"><img src="./images/x.png" id="x" /></a>
<a href="javascript: addYelpInfo()"><img src="./images/add.png" id="add" /></a>
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
?>

    <a href='<?php echo "./initiate.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>
    <a href='javascript: saveList()'><img src="./images/right.png" id="nav-right" /></a> <!-- '<?php echo "./email.php?type=$type&userkey=$userkey"; ?>' and onClick="saveList();"-->
<script type="text/javascript">
<!--
$( function() {
  //initialize sortables
  $('#sortable1, #sortable2').sortable( {
    items: ":not(.ui-state-disabled)",
    cursor: 'move',
    connectWith: ".connectedSortable",
    dropOnEmpty: true
  });
  $("#sortable1, #sortable2").disableSelection();

  // initialize search text
  $('#addnew').hide();
  $('#yelpdata').hide();

  // initialize expand/collapse list
  $('li.heading').children('.info').hide();
  $('li.heading').each( function() {
      $(this).click(function(event) {
	  if (this == event.target) $(this).children('ul').toggle();
	});
    });
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
      window.location = '<?php echo "./email.php?type={$type}&userkey={$userkey}"; ?>';
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