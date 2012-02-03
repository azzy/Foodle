<!DOCTYLE html>
<html lang="en" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Choosine</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.0.6-development-only.js"></script>
<style>
#sortable1, #sortable2 { list-style-type: none; }
</style>
<script type="text/javascript">
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
</script>

<link href="http://fonts.googleapis.com/css?family=Coustard:400|Rokkitt:400" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./css/reset.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />
</head>

<?php
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
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

<body class="rank cuisine">
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="text">
	Rank the cuisines in the green box in order of preference by
      dragging into the blue box. Select as many as you care about,
      and put your very favorites on top!
	</div>

    <div id="list-1">
      <ul id="sortable1" class="connectedSortable">
      <li class="draggable"><span class="names">American (Traditional)</span></li>
      <li class="draggable"><span class="names">Asian Fusion</span></li>
      <li class="draggable"><span class="names">Barbeque</span></li>
      <li class="draggable"><span class="names">Buffets</span></li>
      <li class="draggable"><span class="names">Burgers</span></li>
      <li class="draggable"><span class="names">Chinese</span></li>
      <li class="draggable"><span class="names">Delis</span></li>
      <li class="draggable"><span class="names">Diners</span></li>
      <li class="draggable"><span class="names">Fast Food</span></li>
    </ul>
    </div>
    <div id="list-2">
      <ul id="sortable2" class="connectedSortable">
	<li class="bin"><span class="names">Drop selections here</span></li>
   </ul>
    </div>

    </div>
    <a href='<?php echo "./initiate.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>
    <a href='<?php echo "./email.php?type=$type&userkey=$userkey"; ?>'><img src="./images/right.png" id="nav-right" onClick="saveList();"/></a>
    
  <div class="clear"></div>
  <div id="footer">We know you're really excited to use Choosine,
  but it doesn't exist yet! Sorry :(</div>
  </div>
  </div> <!-- end wrapper -->

</body>
</html>