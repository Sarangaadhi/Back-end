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
                case 'PATCH':
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
                case 'PATCH':
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
        case'conductor':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'ConductorReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'ConductorReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'ConductorCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'ConductorUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'ConductorDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break; 
        case'driver':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'DriverReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'DriverReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'DriverCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'DriverUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'DriverDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break; 
        case'route_type':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'RouteTypeReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'RouteTypeReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'RouteTypeCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'RouteTypeUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'RouteTypeDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break; 
        case'route':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'RouteReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'RouteReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'RouteCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'RouteUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'RouteDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break;
        case'trip':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'TripReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'TripReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'TripCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'TripUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'TripDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break; 
        case'trip_expenses':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'TripExpensesReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'TripExpensesReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'TripExpensesCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'TripExpensesUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'TripExpensesDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break; 
        case'vehicle':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'VehicleReadById',$params);
                    }else{
                        handleRequest($ObjRequest['requestBody'],'VehicleReadAll');
                    }
                    break;
                
                case 'POST':
                    handleRequest($ObjRequest['requestBody'],'VehicleCreate');
                    break;

                case 'PUT':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'VehicleUpdate',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;

                case 'DELETE':
                    if(isset($uri[2]) && is_numeric($uri[2])){
                        $params = [
                            "id" => $uri[2]
                        ];
                        handleRequest($ObjRequest['requestBody'],'VehicleDelete',$params);
                    }else{
                        showResponseErr(400);
                    }
                    break;
                    
                default:
                    showResponseErr(400);
                    break;
            }
            break;  
        case 'dashboard':
            switch ($ObjRequest['requestMethod']) {
                case 'PATCH':
                    handleRequest($ObjRequest['requestBody'],'DashboardLoad');
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