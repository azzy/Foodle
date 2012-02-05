<?php

include("validateRun.php");
require_once("functions/newuser.php");
require_once("functions/newpoll.php");

// Uncomment these to run tests (test data)
//$_POST['dinner'] = "fun dinner";
//$_POST['name'] = "somebody special";
//$_POST['email'] = "2134m";
//$_POST['location'] = "Princeton, NJ";
//echo 'DINNER';

//echo "reached";





if($_POST['formSubmit'] == "Submit") 
    {
	$errorMessage = "";

	$isValid = isValid($_POST['email'], $_POST['location']);

      if($isValid) {
      //echo "AAAAAAAAAARRRRRGHHHHHH";
      // TODO: if the form data is valid, save it to the database
      $pollid = newPoll($_POST['dinner'], $_POST['location']);
     // create an admin user for the poll
     $userkey = newUser($pollid, 'a', $_POST['email'], $_POST['name']);
      }

if ($isValid) {
  echo "true";
} else {
  echo "false";
  $errorMessage .= "invalid";
}
		
		

		if(empty($errorMessage)) 
        {
      		header("Location: thankyou.html");
			exit();
		}
}
            
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>PHP Form processing example</title>
<!-- define some style elements-->
<style>
label,a 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>	
</head>

<body>

       <?php
		    if(!empty($errorMessage)) 
		    {
			    echo("<p>There was an error with your form:</p>\n");
			    echo("<ul>" . $errorMessage . "</ul>\n");
            }
        ?>

		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
			<p>
				<label for='email'>What is your email?</label><br/>
				<input type="text" name="email" maxlength="50" value="<?=$email;?>" />
			</p>
			<p>
				<label for='name'>What is your name?</label><br/>
				<input type="text" name="name" maxlength="50" value="<?=$name;?>" />
			</p>
			<p>
			<label for='dinner'>Dinner</label><br/>
				<input type="text" name="dinner" maxlength="50" value="<?=$dinner;?>" />
			</p>
			<p>
			<label for='location'>Location</label><br/>
				<input type="text" name="location" maxlength="50" value="<?=$location;?>" />
			</p>
			<p>
				
			<input type="submit" name="formSubmit" value="Submit" />
		</form>
		
<p>
<a href='http://www.html-form-guide.com/php-form/php-form-processing.html'
>'PHP form processing' article page</a>
</p>

</body>
</html>