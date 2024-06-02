<?php
    function handleRequest($requestObject, $function, $params=null){
        $result= $params == null ? $function($requestObject) : $function($requestObject, $params);
        showResponse($result);
    }
?>