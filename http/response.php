<?php
function showResponse($result){
    http_response_code($result["http_code"]);
    echo($result["data"]);
    die();
}


?>