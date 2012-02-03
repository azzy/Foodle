<?php
  include("header.php");
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
?>

<script type="text/javascript">
$( init );

function init() {
$('.draggable').draggable( {
containment: 'document',
cursor: 'move',
snap: 'li',
start: $('.draggable').css("top: -40px;")
});
$('.bin').droppable( {
over: $("this").addClass("bin-hover"),
drop: handleDropEvent
});
}

function handleDropEvent( event, ui) {
var draggable = ui.draggable;
//do something
}
</script>
</head>

<body id="cuisine">
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
      <ul class="sort">
      <li class="draggable"><span class="names">American (Traditional)</span></li>
      <li class="draggable"><span class="names">Asian Fusion</span></li>
      <li class="draggable"><span class="names">Barbeque</span></li>
      <li class="draggable"><span class="names">Buffets</span></li>
      <li class="draggable"><span class="names">Burgers</span></li>
      <li class="draggable"><span class="names">Chinese</span></li>
      <li class="draggable"><span class="names">Delis</span></li>
      <li class="draggable"><span class="names">Diners</span></li>
      <li class="draggable"><span class="names">Fast Food</span></li>
      <li class="draggable"><span class="names">French</span></li>
      <li class="draggable"><span class="names">Greek</span></li>
      <li class="draggable"><span class="names">Indian</span></li>
      <li class="draggable"><span class="names">Italian</span></li>
      <li class="draggable"><span class="names">Japanese</span></li>
      <li class="draggable"><span class="names">Korean</span></li>
      <li class="draggable"><span class="names">Malaysian</span></li>
      <li class="draggable"><span class="names">Mediterranean</span></li>
      <li class="draggable"><span class="names">Mexican</span></li>
      <li class="draggable"><span class="names">Pakistani</span></li>
      <li class="draggable"><span class="names">Pizza</span></li>
      <li class="draggable"><span class="names">Portuguese</span></li>
      <li class="draggable"><span class="names">Sandwiches</span></li>
      <li class="draggable"><span class="names">Seafood</span></li>
      <li class="draggable"><span class="names">Soup</span></li>
      <li class="draggable"><span class="names">Spanish</span></li>
      <li class="draggable"><span class="names">Steakhouses</span></li>
      <li class="draggable"><span class="names">Sushi Bars</span></li>
      <li class="draggable"><span class="names">Tex-Mex</span></li>
      <li class="draggable"><span class="names">Thai</span></li>
      <li class="draggable"><span class="names">Vegetarian</span></li>
      <li class="draggable"><span class="names">Vietnamese</span></li>
    </ul>
    </div>
    <div id="list-2">
      <ul class="sort">
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
      <li class="bin"></li>
    </ul>
    </div>

    </div>
    <a href="#"><img src="./images/left.png" id="nav-left" /></a>
    <a href="#"><img src="./images/right.png" id="nav-right" /></a>
    
  <div class="clear"></div>
  <div id="footer">We know you're really excited to use Choosine,
  but it doesn't exist yet! Sorry :(</div>
  </div>
  </div> <!-- end wrapper -->

</body>
</html>
