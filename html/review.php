<?php
  include("header.php");
?>
<body class="review cuisine">
<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
    <div id="content-area">
      <div class="text">Please confirm the information below.</div>
      <div class="form">
	<table>
	  <tr>
	  <td><label for="dinner">Dinner Name:</label></td>
	  <td>Name of Dinner</td>
	</tr><tr>
	  <td><label for="name">Your Name:</label></td>
	  <td>Their Name</td>
	</tr><tr>
	  <td><label for="email">Your Email:</label></td>
	  <td>Their Email</td>
	</tr><tr>
	  <td><label for="location">Your Location:</label></td>
	  <td>Their Location</td>
	</tr><tr>
	  <td><label for="number">Number of Guests:</label></td>
	  <td>Number of guests</td>
	</tr><tr>
	  <td>Email address of guest 1</td>
	</tr><tr>
	  <td>Email address of guest 2</td>
	</tr><tr>
	  <td>Email address of guest 3</td>
	</tr><tr>
	  <td>Email addresses continued</td>
	</tr>
      </table>
      </div>

      </div>
    <a href='<?php echo "./emails.php?type=$type&userkey=$userkey"; ?>'><img src="./images/left.png" id="nav-left" /></a>
    <a href='<?php echo "./ranksort.php?type=$type&userkey=$userkey"; ?>'><img src="./images/right.png" id="nav-right" /></a>
    
  <div class="clear"></div>
  <div id="footer">We know you're really excited to use Choosine, but
  it doesn't exist yet! Sorry :(</div>

  </div>
 </div> <!-- end wrapper -->

</body>
</html>
