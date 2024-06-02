<?php
    include_once 'config/JWT.php';
    
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;

    function UserCreate($requestObject){
        //database operation.

        $requestObject->data->id = 123;

        $result = [
            'http_code' => 200,
            'data' => json_encode($requestObject->data)
        ];

        return $result;
    }

    function UserLogin($requestObject){

        $id = 123;       

        //database operation.
                
        
        $issuer_claim = config_JWT::$jwt_issuer;
        $audience_claim = config_JWT::$jwt_audience;
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + config_JWT::$jwt_not_before;
        $expire_claim = $issuedat_claim + config_JWT::$jwt_expire_after;
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
                "username" => "john",
                "email" => $requestObject->data->email
        ));

        $ObjResponse['http_code'] = http_response_code(200);
        $ObjResponse['data']['status'] = "success";
        $ObjResponse['data']['message'] = "Successful login.";
        $ObjResponse['data']['token'] = JWT::encode($token, config_JWT::$jwt_secret_key, config_JWT::$jwt_algorithm);
        $ObjResponse['data']['expireAt'] = $expire_claim;


        $result = [
            'http_code' => $ObjResponse['http_code'],
            'data' => json_encode($ObjResponse['data'])
        ];

        return $result;
    }

    function UserReadAll($requestObject){

        $ObjResponse['http_code'] = http_response_code(200);
        $ObjResponse['data'] = "dummy data here";

        $result = [
            'http_code' => $ObjResponse['http_code'],
            'data' => json_encode($ObjResponse['data'])
        ];

        return $result;
    }

    function UserReadById($requestObject, $params){
        
        $ObjResponse['http_code'] = http_response_code(200);
        $ObjResponse['data'] = "dummy data here: id=" . $params['id'];

        $result = [
            'http_code' => $ObjResponse['http_code'],
            'data' => json_encode($ObjResponse['data'])
        ];

        return $result;
    }



?>