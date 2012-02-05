<?php
    include_once("cuisines.php");
    include_once("foodledbinfo.php");
    include_once("newpoll.php");
    include_once("newuser.php");
    
    function addItems($arrOfIds, $idToCuis) {
        $num = count($arrOfIds);
        for ($i = 0 ; $i < $num; $i++) {
            $name=$idToCuis[$arrOfIds[$i]];
            echo '<li class="draggable heading" id="'.$i.'">'.$name.'</li>';
        }
    }

?>