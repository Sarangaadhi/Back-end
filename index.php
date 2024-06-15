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
        showResponseErr(422);
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
        showResponseErr(401);
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
                    handleRequest($ObjRequest['requestBody'],'UserCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'UserUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'UserDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break;   
        
        case'employee':
            switch ($ObjRequest['requestMethod']) {
                case 'GET':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'EmployeeReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'EmployeeReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'EmployeeCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'EmployeeUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'EmployeeDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break; 
        
        
        
       
        default:
            showResponseErr(503);
            break;
    }



?>