<?php
   include("header.php");
?>

<body class="emails cuisine">
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
    <div class="text">Your Guests' Emails:</div>
    <form name="input" method="post">
    <div class="form" id="emails-form">
      <input />
      <input />
      <input />
    </div>
    <a href="javascript:add_field()"><div id="addnew">
      <img src="./images/add.png" />Add another person</div></a>
      <a href="thankyou.php"><input type="submit" value="create poll" name="submit" class="submit" /></a>
	</form>
	
	<div id="template" style="display:none">
	  <input />
	</div>
    </div>
    
    <a href="ranksort.php"><img src="./images/left.png" id="nav-left" /></a>   
  <div class="clear"></div>

  </div>
 </div> <!-- end wrapper -->

</body>
</html>
