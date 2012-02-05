<?php
  include("header.php");
  include("validateRun.php");
  require_once("functions/newuser.php");
  require_once("functions/newpoll.php");
  $type = $_GET['type'];
  $userkey = $_GET['userkey'];
  echo '</head><body class="initiate '.$type.'">';
  if($_POST['email']!= "") 
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
          header("Location: ranksort.php?type=".$type."&userkey=".$userkey);
    }
}
            
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title></title>
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

<div id="banner"><a href="./index.php"><img src="./images/choosine.png"/></a></div>
<div id="wrapper">
  <div id="container">
   <div id="content-area">
    <div class="form">
      <form name="input" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
      <table>
  <tr>
    <td><label for="dinner">Dinner Name:</label></td>
    <td><input type="text" id="dinner" name="dinner" value="<?=$dinner;?>"/></td>
  </tr><tr>
    <td><label for="name">Your Name:</label></td>
    <td><input type="text" id="name" name="name" value="<?=$name;?>"/></td>
  </tr><tr>
    <td><label for="email">Your Email:</label></td>
    <td><input type="text" id="email" name="email" placeholder="" value="<?=$email;?>" /></td>
  </tr><tr>
    <td><label for="location">Your Location:</label></td>
    <td><input type="text" id="location" name="location" placeholder="City, State or ZIP" value="<?=$location;?>" / ></td>
  </tr>
      </table>
      </form>
    </div>
    </div><!-- end content-area -->
    <a href='./index.php'><img src="./images/left.png" id="nav-left" /></a>
    <script type="text/javascript">
   function submitform() {
    document.input.submit();
   }
    </script>
    <a href='javascript: submitform()'><img src="./images/right.png" id="nav-right" /></a>
<?php
    require_once "footer.php";
?>
