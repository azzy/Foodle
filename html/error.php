<?php
  include("header.php");
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
  echo '<style> .404 { font-size : 100px}</style>';
  echo '</head><body class="review '.$type.'">';
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="404">404</div><br>
      <div class="text">There seems to have been an error. We offer our deepest apologies, dear choosiners.</div>
	<div class="text">
        <a href='choosine.com'>Choosine.com</a><br/><br/>
        "There is no love sincerer than the love of food." - George Bernard Shaw (1856 - 1950)
    </div>
    </div>
    
    <a href='choosine.com'><img src="./images/left.png" id="nav-left" /></a>
    <a href='choosine.com'><img src="./images/right.png" id="nav-right" /></a>

    <?php include("footer.php"); ?>