<?php
  include("header.php");
  $type = $_GET['type'];
?>
<body class="review cuisine">
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="text">Thank you for using Choosine! Please use the
	following URL to view your results.</div>
	<div class="text">321kl4jsdfglkjl1;14235j;</div>
      </div>
    <a href='<?php echo "./emails.php?type=$type"; ?>'><img src="./images/left.png" id="nav-left" /></a>
    <a href='<?php echo "./ranksort.php?type=$type"; ?>'><img src="./images/right.png" id="nav-right" /></a>
    
  <div class="clear"></div>
  <div id="footer">We know you're really excited to use Choosine, but
  it doesn't exist yet! Sorry :(</div>

  </div>
 </div> <!-- end wrapper -->

</body>
</html>
