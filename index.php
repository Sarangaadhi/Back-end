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

        case'user':
            switch ($ObjRequest['requestMethod']) {
                case 'GET':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'UserReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'UserReadAll');
                    }
                    break;
                
                case 'POST':
                    echo("GET request");
                    break;

                case 'PUT':
                    echo("GET request");
                    break;

                case 'DELETE':
                    echo("GET request");
                    break;
                    
                default:
                    echo("INVALID request");
                    break;
            }
            break;   
        default:
            $response['http_code'] = 503;
            $response['data'] = "Request can not be processed";
            showResponse($response);
            break;
    }



?>