<?php
    include 'config/Api_Headers.php';
    include_once 'config/Auto_Loader.php';
   
    $ObjRequest = [
        'endpoint' => $_SERVER['REQUEST_URI'],
        'accept' => $_SERVER['HTTP_ACCEPT'],
        'requestMethod' => $_SERVER['REQUEST_METHOD'],
        'requestBody' => json_decode(file_get_contents('php://input')),
        'token' => ""
    ];

    if($ObjRequest['accept'] != "application/json"){
        $response['http_code'] = 400;
        $response['data'] = "Unprocessable";
        showResponse($response);
    }
       
    $uri = explode("/", $ObjRequest['endpoint']);

    switch ($uri[1]) {
        case 'register':
            handleRequest($ObjRequest['requestBody'],'UserCreate');
            break;
        case'login':
            handleRequest($ObjRequest['requestBody'],'UserLogin');
            break;     
        
        default:
            $response['http_code'] = 503;
            $response['data'] = "Request can not be processed";
            showResponse($response);
            break;
    }



?>