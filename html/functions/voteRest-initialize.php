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
    
    
    //echo("<br/><br/>");
?>
<html>
    <head>
        <title>Test</title>
    </head>

<body>
    lalalala
    <p><?php echo("userkey ".$userkey." pollid ".$pollid."<br/><br/>");?></p>
</body>
</html>


