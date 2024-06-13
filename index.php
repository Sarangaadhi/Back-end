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


    //Authorization
    $authorized = false;
    if(isset($uri[1]) && $uri[1]==="login"){
        $authorized = true;
    }else{
        $request_data = json_decode(file_get_contents('php://input'));
        $ObjRequest['token'] = $request_data->token;
        $authorized = User_authorize($ObjRequest['token']);
    }

    if (!$authorized) {
        $response = [
            'http_code' => 401,
            'data' => json_encode(['message' => 'Not Authorized']),
        ];
        showResponse($response);
    }


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
                    echo("POST request");
                    break;

                case 'PUT':
                    echo("PUT request");
                    break;

                case 'DELETE':
                    echo("DELETE request");
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