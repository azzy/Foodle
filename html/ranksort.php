<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
  include("header.php");
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
?>
<script type="text/javascript">
    /*$( function() {
  $('#sortable1, #sortable2').sortable( {
    cursor: 'move',
    connectWith: ".connectedSortable",
    dropOnEmpty: true
  });
  $("#sortable1, #sortable2").disableSelection();
  }),*/
$(document).ready(function() {
  $('li.heading').children('ul').hide();
  $('li.heading').each(
    function(column) {
      $(this).click(function(event) {
        if (this == event.target) $(this).children('ul').toggle();
      });
    }
  );
});
</script>

<?php
  echo '</head><body class="rank '.$type.'">';
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
      <li class="draggable heading">Restaurant Name
          <ul class="info"><li>Information loaded from YELP API</li></ul>
      </li>
      <li class="draggable heading">Restaurant Name
          <ul class="info"><li>Information loaded from YELP API</li></ul>
      </li>
      <li class="draggable heading">Restaurant Name
          <ul class="info"><li>Information loaded from YELP API</li></ul>
      </li>
      <li class="draggable heading">Restaurant Name
          <ul class="info"><li>Information loaded from YELP API</li></ul>
      </li>
    </ul>
    </div>
    <div id="list-2">
      <ul id="sortable2" class="connectedSortable">
	<li class="bin">Drop selections here</li>
   </ul>
    </div>

    </div>

    <script type="text/javascript">
    function saveList() {

      alert($("#sortable2").sortable("toArray"));
      var jsonList = $("#sortable2").sortable("toArray");
      jsonList.userkey = '<?php echo $userkey ?>';
      $.ajax({
	type: 'POST',
	traditional: true,
	data: jsonList,
	url: '/ajax/saveList.php',
	success: function(data) {
	  alert('YAY! Post success: ' + data);
	},
	error: function(error) {
	  alert('Error on post: ' + error);
	}
      });
    }
    //-->
    </script>

    <a href='<?php echo "./initiate.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>
    <a href='<?php echo "./email.php?type=$type&userkey=$userkey"; ?>'><img src="./images/right.png" id="nav-right" onClick="saveList();"/></a>
    
    <?php include("footer.php"); ?>