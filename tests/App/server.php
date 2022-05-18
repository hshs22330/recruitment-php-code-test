<?php

if ($_SERVER["REQUEST_URI"] == "/user_info") {
    echo json_encode(user_info());
}

function user_info(){
    return ["error"=>0,"data"=>["id"=>1,"username"=>"hello world"]];
}
