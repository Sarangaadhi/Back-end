<?php
    
    function RouteTypeCreate($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to insert entity
            $query = "INSERT INTO `route_type` 
            (`route_type_name`, `created_at`) VALUES
            (:route_type_name, current_timestamp())";

            // Query parameters
            $params = [
                'route_type_name' => $requestObject->data->route_type_name
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
 
    function RouteTypeReadAll($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];

        try {
            //Instantitate Database Class
            $db = new Database();

            $query = "SELECT 
                    `id`,
                    `route_type_name`,
                    `is_active`,
                    `is_deleted` 
                FROM route_type 
                WHERE
                    `is_active`= :is_active AND
                    `is_deleted`= :is_deleted";

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
                    $obj = new RouteType(
                        $db_result[$i]['id'],
                        $db_result[$i]['route_type_name'],
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

    function RouteTypeReadById($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to select entity
            $query = "SELECT 
                    `id`,
                    `route_type_name`,
                    `is_active`,
                    `is_deleted` 
                FROM route_type 
                WHERE
                    `id`= :id AND
                    `is_deleted`= :is_deleted";

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
                    $obj = new RouteType(
                        $db_result[$i]['id'],
                        $db_result[$i]['route_type_name'],
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

    function RouteTypeUpdate($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to update entity
            $query = "UPDATE route_type SET
                    `route_type_name`= :route_type_name,
                    `is_active`=:is_active,
                    `is_deleted`=:is_deleted 
                WHERE `id`= :id";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
                'route_type_name' => $requestObject->data->route_type_name,
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
    
    function RouteTypeDelete($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to delete entity
            $query = "UPDATE route_type SET `is_deleted`= 1 WHERE `id`= :id";

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