<?php
    include_once("cuisines.php");
    include_once("foodledbinfo.php");
    include_once("newpoll.php");
    include_once("newuser.php");
    
//$userkey = "B3EF2465-24E8-AC67-5076-0D3C22571FD0";
/* $userkey=$_GET['userkey'];
    $userinfo = getUserInfo($userkey);
    $pollid = $userinfo['pollid'];
    
    $arrOfIds = getPollChoices($pollid);*/
    
    function populateCuisines($arrOfIds, $idToCuis) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $response=getData($arrOfIds[$i]);
            $id = $response["id"];
	    $name = $response["name"];
	    echo '<li class="draggable heading" id="'.$id.'">'.$name;
	    echo '<ul class="info ui-state-disabled">
<li class="yelprating ui-state-disabled"><img src="'.$response['ratingimg'];
	    echo '" /></li>
<li class="yelpsnippet ui-state-disabled">Review: '.$response['snippet'];
	    //figure out categories later. for now let's just pretend they're not here.
	    //echo '</li><li class="yelpcat ui-state-disabled">'.$response['categories'];
	    echo '</li><li class="readmore ui-state-disabled"><a href="'.$response['url'];
	    echo '">Read more on Yelp.com</a></li></ul></li>';
        }
    }
/*
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
*/?>