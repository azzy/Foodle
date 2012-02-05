<?php
    include("cuisines.php");
    include("foodledbinfo.php");
    include("newpoll.php");
    include("newuser.php");
    
    $userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
    //$userkey=$_GET['userkey'];
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];
    
    $arrOfIds = getPollChoices($pollid);
    
    function addItems($arrOfIds, $idToCuis) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $name = $idToCuis[$arrOfIds[$i]];
            echo("<li class='restaurant'>".$name."</li>");
        }
    }
?>
<html>
    <head>
        <title>Test</title>
    </head>

<body>
    Prints list of cuisines for the given poll
    <p><?php echo("userkey ".$userkey." pollid ".$pollid."<br/><br/>");?></p>
    <p><?php print_r($arrOfIds);?></p>
    <p><?php echo("here");?></p>
    <ul id="cuslist">
        <?php addItems($arrOfIds, $idToCuis);?>
    </ul>
</body>
</html>

