<?php
  include("header.php");
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
  echo '</head>
<body class="review cuisine">';
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="text">Thank you for using Choosine! Please use the
	following URL to view your results.</div>
	<div class="text">
        <a href=<?php echo "./ranksort.php?type=$type&userkey=$userkey";?>>Vote for your poll!</a> <br/>
        <a href=<?php echo "./results.php?type=$type&userkey=$userkey"?>>Check your poll results!</a> <br>
        <a href=<?php echo "./events_test.php?type=$type&userkey=$userkey"?>>Create a Facebook Event!</a>
    </div>
    </div>
    
    <a href='<?php echo "./email.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>

    <?php include("footer.php"); ?>