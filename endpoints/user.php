<?php
    include_once 'config/JWT.php';
    
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;

    function UserCreate($requestObject){
        //Instantitate Database Class
        $db = new Database();

        //SQL query to select users
        $query = "INSERT INTO `user` 
        (`username`, `email`, `password`, `is_manager`, `is_admin`, `is_active`, `is_deleted`, `created_at`) VALUES
        (:username, :email, :password, :is_manager, :is_admin, '1', '0', current_timestamp()";

        // Query parameters
        $params = [
            'username' => $requestObject->data->username,
            'email' => $requestObject->data->email,
            'password' => $requestObject->data->password,
            'is_manager' => $requestObject->data->isManager,
            'is_admin' => $requestObject->data->isAdmin,
        ];

        //Query result
        $db_result = $db->query($query,$params);
        
        $requestObject->data->id = $db_result;

        $result = [
            'http_code' => 200,
            'data' => json_encode($requestObject->data)
        ];

        return $result;
    }

    function UserLogin($requestObject){

        //Instantitate Database Class
        $db = new Database();

        //SQL query to select users
        $query = "SELECT `id`, `username`, `email`,  `password`, `is_manager`, `is_admin`, `is_active`, `is_deleted` FROM user WHERE `is_active`= :is_active AND `email`= :email";

        // Query parameters
        $params = [
            'email' => $requestObject->data->email,
            'is_active' => '1',            
        ];

        //Query result
        $db_result = $db->query($query,$params);
          
        if(count($db_result) > 0){
            $db_result[0]['password'] == $requestObject->data->password;

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
                    "id" => $db_result[0]['id'],
                    "username" => $db_result[0]['username'],
                    "email" => $db_result[0]['email']
            ));
    
            $ObjResponse['http_code'] = http_response_code(200);
            $ObjResponse['data']['status'] = "success";
            $ObjResponse['data']['message'] = "Successful login.";
            $ObjResponse['data']['token'] = JWT::encode($token, config_JWT::$jwt_secret_key, config_JWT::$jwt_algorithm);
            $ObjResponse['data']['expireAt'] = $expire_claim;
                   
            return [
                'http_code' => $ObjResponse['http_code'],
                'data' => json_encode($ObjResponse['data'])
            ];            
        }
        
        return [
            'http_code' => http_response_code(200),
            'data' => "Not Authorized"
        ];
    }

    function UserReadAll($requestObject){
        //Instantitate Database Class
        $db = new Database();

        //SQL query to select users
        $query = "SELECT `id`, `username`, `email`, `password`, `is_manager`, `is_admin`, `is_active`, `is_deleted` FROM user WHERE `is_active`= :is_active AND `is_deleted`= :is_deleted";

        // Query parameters
        $params = [
            'is_active' => '1',
            'is_deleted' => '0',
        ];

        //Query result
        $db_result = $db->query($query,$params);

        //inititalize reults array
        $results = [];

        if(count($db_result) > 0){
            for ($i=0; $i < count($db_result) ; $i++) { 
                $user = new User(
                    $db_result[$i]['id'],
                    $db_result[$i]['username'],
                    $db_result[$i]['email'],
                    $db_result[$i]['password'],
                    $db_result[$i]['is_manager'],
                    $db_result[$i]['is_admin'],
                    $db_result[$i]['is_active'],
                    $db_result[$i]['is_deleted']
                );
                //Pushing objects to results array
                array_push($results,$user->make_json());
            }
        }

        $response = [
            'http_code' => http_response_code(200),
            'data' => json_encode($results)
        ];
        return $response;
    }

    function UserReadById($requestObject, $params){}

    function User_authorize($jwt){
        if($jwt){
            try {
                JWT::decode($jwt, new Key(Config_JWT::$jwt_secret_key, Config_JWT::$jwt_algorithm));
                return true;
            } catch (Exception $e){
                return false;
            }
        }else{
            return false;
        }
    }


?>