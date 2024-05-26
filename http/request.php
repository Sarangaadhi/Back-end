<?php
function handleRequest($requestObject,$function){
    $result=$function($requestObject);
    showResponse($result);
}
?>