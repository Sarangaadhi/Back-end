<?php
    
    function RouteCreate($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to insert entity
            $query = "INSERT INTO `route` 
            (`route_type_id`, `route_number`, `route_name`, `route_description`, `route_length`, `created_at`) VALUES
            (:route_type_id, :route_number, :route_name, :route_description, :route_length, current_timestamp())";

            // Query parameters
            $params = [
                'route_type_id' => $requestObject->data->route_type_id,
                'route_number' => $requestObject->data->route_number,
                'route_name' => $requestObject->data->route_name,
                'route_description' => $requestObject->data->route_description,
                'route_length' => $requestObject->data->route_length
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
 
    function RouteReadAll($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];

        try {
            //Instantitate Database Class
            $db = new Database();

            $query = "SELECT 
                    `id`,
                    `route_type_id`,
                    `route_number`,
                    `route_name`,
                    `route_description`,
                    `route_length`,
                    `is_active`,
                    `is_deleted` 
                FROM route 
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
                    $obj = new Route(
                        $db_result[$i]['id'],
                        $db_result[$i]['route_type_id'],
                        $db_result[$i]['route_number'],
                        $db_result[$i]['route_name'],
                        $db_result[$i]['route_description'],
                        $db_result[$i]['route_length'],
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

    function RouteReadById($requestObject, $params){
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
                    `route_type_id`,
                    `route_number`,
                    `route_name`,
                    `route_description`,
                    `route_length`,
                    `is_active`,
                    `is_deleted` 
                FROM route 
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
                    $obj = new Route(
                        $db_result[$i]['id'],
                        $db_result[$i]['route_type_id'],
                        $db_result[$i]['route_number'],
                        $db_result[$i]['route_name'],
                        $db_result[$i]['route_description'],
                        $db_result[$i]['route_length'],
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

    function RouteUpdate($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to update entity
            $query = "UPDATE route SET
                    `route_type_id`= :route_type_id,
                    `route_number`= :route_number,
                    `route_name`= :route_name,
                    `route_description`= :route_description,
                    `route_length`= :route_length,
                    `is_active`=:is_active,
                    `is_deleted`=:is_deleted 
                WHERE `id`= :id";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
                'route_type_id' => $requestObject->data->route_type_id,
                'route_number' => $requestObject->data->route_number,
                'route_name' => $requestObject->data->route_name,
                'route_description' => $requestObject->data->route_description,
                'route_length' => $requestObject->data->route_length,
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
    
    function RouteDelete($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to delete entity
            $query = "UPDATE route SET `is_deleted`= 1 WHERE `id`= :id";

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