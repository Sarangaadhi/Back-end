<?php
    include_once 'config/JWT.php';
    
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;

    function UserCreate($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to select users
            $query = "INSERT INTO `user` 
            (`employee_id`, `username`, `password`, `is_manager`, `is_admin`, `created_at`) VALUES
            (:employee_id, :username, :password, :is_manager, :is_admin, current_timestamp())";

            // Query parameters
            $params = [
                'employee_id' => $requestObject->data->employee_id,
                'username' => $requestObject->data->username,
                'password' => $requestObject->data->password,
                'is_manager' => $requestObject->data->is_manager,
                'is_admin' => $requestObject->data->is_admin,
            ];

            //Query result
            $db_result = $db->query($query,$params);
            
            $requestObject->data->id = $db_result;

            $response = [
                'http_code' => 200,
                'data' => json_encode($requestObject->data)
            ];

        } catch (Exception $ex) {
            $response = [
                'http_code' => http_response_code(500),
                'data' => json_encode($ex)
            ];
        }finally{
            return $response;    
        }        
    }

    function UserLogin($requestObject){
        //Instantitate Database Class
        $db = new Database();

        //SQL query to select users
        $query = "SELECT `id`, `employee_id`, `username`, `password`, `is_manager`, `is_admin`, `is_active`, `is_deleted` FROM user WHERE `is_active`= :is_active AND `username`= :username";

        // Query parameters
        $params = [
            'username' => $requestObject->data->username,
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
                    "employeeId" => $db_result[0]['employee_id'],
                    "username" => $db_result[0]['username'],
                    "isAdmin" => $db_result[0]['is_admin'],
                    "isManager" => $db_result[0]['is_manager'],
                    "isActive" => $db_result[0]['is_active']
                )
            );
    
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
        
        showResponseErr(401);
    }

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

    function UserReadAll($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];

        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to select users
            $query = "SELECT `id`, `employee_id`, `username`, `password`, `is_manager`, `is_admin`, `is_active`, `is_deleted` FROM user WHERE `is_active`= :is_active AND `is_deleted`= :is_deleted";

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
                    $obj = new User(
                        $db_result[$i]['id'],
                        $db_result[$i]['employee_id'],
                        $db_result[$i]['username'],
                        $db_result[$i]['password'],
                        $db_result[$i]['is_manager'],
                        $db_result[$i]['is_admin'],
                        $db_result[$i]['is_active'],
                        $db_result[$i]['is_deleted']
                    );
                    //Pushing objects to results array
                    array_push($results,$obj->make_json());
                }
            }

            $response = [
                'http_code' => http_response_code(200),
                'data' => json_encode($results)
            ];
        } catch (Exception $ex) {
            $response = [
                'http_code' => http_response_code(500),
                'data' => json_encode($ex)
            ];
        }finally{
            return $response;    
        }
    }

    function UserReadById($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to select users
            $query = "SELECT `id`, `employee_id`, `username`, `password`, `is_manager`, `is_admin`, `is_active`, `is_deleted` FROM user WHERE `id`= :id AND `is_deleted`= :is_deleted";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
                'is_deleted' => '0',
            ];

            //Query result
            $db_result = $db->query($query,$db_params);

            //inititalize reults array
            $results = [];

            if(count($db_result) > 0){
                for ($i=0; $i < count($db_result) ; $i++) { 
                    $obj = new User(
                        $db_result[$i]['id'],
                        $db_result[$i]['employee_id'],
                        $db_result[$i]['username'],
                        $db_result[$i]['password'],
                        $db_result[$i]['is_manager'],
                        $db_result[$i]['is_admin'],
                        $db_result[$i]['is_active'],
                        $db_result[$i]['is_deleted']
                    );
                    //Pushing objects to results array
                    array_push($results,$obj->make_json());
                }
            }
            $response = [
                'http_code' => http_response_code(200),
                'data' => json_encode($results)
            ];
        } catch (Exception $ex) {
            $response = [
                'http_code' => http_response_code(500),
                'data' => json_encode($ex)
            ];
        }finally{
            return $response;    
        }
    }

    function UserUpdate($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to select users
            $query = "UPDATE user SET `employee_id`=:employee_id, `username`=:username, `password`=:password, `is_manager`=:is_manager, `is_admin`=:is_admin, `is_active`=:is_active, `is_deleted`=:is_deleted WHERE `id`= :id";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
                'employee_id' => $requestObject->data->employee_id,
                'username' => $requestObject->data->username,
                'password' => $requestObject->data->password,
                'is_manager' => $requestObject->data->is_manager,
                'is_admin' => $requestObject->data->is_admin,
                'is_active' => $requestObject->data->is_active,
                'is_deleted' => '0',
            ];

            //Query result
            $db->query($query,$db_params);

            $response = [
                'http_code' => http_response_code(200),
                'data' => json_encode([
                    'message' => 'Update Successful'
                ])
            ];

        } catch (Exception $ex) {
            $response = [
                'http_code' => http_response_code(500),
                'data' => json_encode($ex)
            ];
        }finally{
            return $response;    
        }
    }
    
    function UserDelete($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to select users
            $query = "UPDATE user SET `is_deleted`= 1 WHERE `id`= :id";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
            ];

            //Query result
            $db->query($query,$db_params);

            $response = [
                'http_code' => http_response_code(204),
                'data' => json_encode([
                    'message' => 'Delete Successful'
                ])
            ];

        } catch (Exception $ex) {
            $response = [
                'http_code' => http_response_code(500),
                'data' => json_encode($ex)
            ];
        }finally{
            return $response;    
        }
    }

?>