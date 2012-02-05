<?php
    include("cuisines.php");
    include("foodledbinfo.php");
    include("newpoll.php");
    include("newuser.php");
    
    $userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
    
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];
    
    $arrOfIds = getPollChoices($pollid);
    /*
    function addItems($arrOfIds, $idToCuis) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $name = $idToCuis[$arrOfIds[$i]];
            echo("<li class='restaurant'>".$name."</li>");
        }
    }
    */

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
    <p><?php print_r($idToCuis);?></p>
    <ul id="cuslist">
        
    </ul>
</body>
</html>


