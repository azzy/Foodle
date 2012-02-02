<?php
  //-----------------------------------------------------------------------
  // Author: Choosine
  //-----------------------------------------------------------------------
?>
<?php
require_once "header.php";
?>
<div class="text">
  Your Guests' Emails:
</div>

	  <div class="form">
                <form name="input" method="post">
<?php
for ($i=1;$i<=5;$i++) {
echo '<input id="email-'.$i.'" name="email-'.$i.'" />';
}
?>
		</form>
	 </div>
    </div><!-- end content-area -->
    <a href="./initiate.html"><img src="./images/left.png" id="nav-left" /></a>
    <a href="./ranksort.html"><img src="./images/right.png" id="nav-right" /></a>

<?php
require_once "footer.php";
?>