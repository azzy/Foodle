<?php
    $response['name'] = "restuarant name";
    $response['id'] = "restaurant id";
    //echo $_POST['id'] . "6";
    $json = { "name" : "restaurant name", "id" : "restaurant id"};
    echo {"id" : $_POST[searchTxt]};
    //echo json_encode($response);
?>