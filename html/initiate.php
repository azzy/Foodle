<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
  include("header.php");
  $type = $_GET['type'];
  echo '<body class="initiate '.$type.'">';
?>
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
   <div id="content-area">
    <div class="form">
      <form name="input" method="post">
      <table>
	<tr>
	  <td><label for="dinner">Dinner Name:</label></td>
	  <td><input id="dinner" name="dinner" /></td>
	</tr><tr>
	  <td><label for="name">Your Name:</label></td>
	  <td><input id="name" name="name" /></td>
	</tr><tr>
	  <td><label for="email">Your Email:</label></td>
	  <td><input id="email" name="email" placeholder="" /></td>
	</tr><tr>
	  <td><label for="location">Your Location:</label></td>
	  <td><input id="location" name="location" placeholder="City, State or ZIP"/></td>
	</tr>
      </table>
      </form>
    </div>
    </div><!-- end content-area -->
    <a href='./index.php'><img src="./images/left.png" id="nav-left" /></a>
    <a href='<?php echo "./ranksort.php?type=$type"; ?>'><img src="./images/right.png" id="nav-right" /></a>

<?php
require_once "footer.php";
?>