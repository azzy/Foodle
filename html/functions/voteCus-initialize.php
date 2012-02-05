<?php
    require_once ('lib/OAuth.php');
    include("access.php");
    include("parse.php");
    include("formmatch.php");
    include("foodledbinfo.php");
    include("newpoll.php");
    include("newuser.php");
    
    $userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
    
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];
    
    $arrOfIds = getPollChoices($pollid);
    
    function addItems($arrOfIds) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $name = $arrOfIds[$i];
            echo("<li class='restaurant'>".$name."</li>");
        }
    }

    //echo("<br/><br/>");
?>
<html>
    <head>
        <title>Test</title>
    </head>

<body>
    lalalala
    <p><?php echo("userkey ".$userkey." pollid ".$pollid."<br/><br/>");?></p>
    <p><?php print_r($arrOfIds);?></p>
    <ul id="cuslist">
        <?php addItems($arrOfIds);?>
    </ul>
</body>
</html>


