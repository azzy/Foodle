<?php
    //$response['name'] = "restuarant name";
    //$response['id'] = "restaurant id";
    //echo $_POST['id'] . "6";
    //$json = { "name" : "restaurant name", "id" : "restaurant id"};
    
    //Get Post variables. Name is the same as
    // what was in the object that was sent in the jquery
    if (isset($_POST['sendValue'])) {
        $value = $_POST['sendValue'];
    } else {
        $value = "";
    } 
    echo json_encode(array("returnValue"=>"This is returned from PHP : ".$value));
    //echo json_encode($response);
?>