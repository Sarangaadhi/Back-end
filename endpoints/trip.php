<?php
    
    function TripCreate($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to insert entity
            $query = "INSERT INTO `trip` 
            (`vehicle_id`, `route_id`, `trip_number`, `fuel_consumed`, `distance_traveled`, `cash_collected`, `is_final`, `created_at`) VALUES
            (:vehicle_id, :route_id, :trip_number, :fuel_consumed, :distance_traveled, :cash_collected, :is_final, current_timestamp())";

            // Query parameters
            $params = [
                'vehicle_id' => $requestObject->data->vehicle_id,
                'route_id' => $requestObject->data->route_id,
                'trip_number' => $requestObject->data->trip_number,
                'fuel_consumed' => $requestObject->data->fuel_consumed,
                'distance_traveled' => $requestObject->data->distance_traveled,
                'cash_collected' => $requestObject->data->cash_collected,
                'is_final' => $requestObject->data->is_final
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
 
    function TripReadAll($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];

        try {
            //Instantitate Database Class
            $db = new Database();

            $query = "SELECT 
                    `id`,
                    `vehicle_id`,
                    `route_id`,
                    `trip_number`,
                    `fuel_consumed`,
                    `distance_traveled`,
                    `cash_collected`,
                    `is_final`,
                    `is_active`,
                    `is_deleted` 
                FROM trip 
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
                    $obj = new Trip(
                        $db_result[$i]['id'],
                        $db_result[$i]['vehicle_id'],
                        $db_result[$i]['route_id'],
                        $db_result[$i]['trip_number'],
                        $db_result[$i]['fuel_consumed'],
                        $db_result[$i]['distance_traveled'],
                        $db_result[$i]['cash_collected'],
                        $db_result[$i]['is_final'],
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

    function TripReadById($requestObject, $params){
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
                    `vehicle_id`,
                    `route_id`,
                    `trip_number`,
                    `fuel_consumed`,
                    `distance_traveled`,
                    `cash_collected`,
                    `is_final`,
                    `is_active`,
                    `is_deleted` 
                FROM trip 
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
                    $obj = new Trip(
                        $db_result[$i]['id'],
                        $db_result[$i]['vehicle_id'],
                        $db_result[$i]['route_id'],
                        $db_result[$i]['trip_number'],
                        $db_result[$i]['fuel_consumed'],
                        $db_result[$i]['distance_traveled'],
                        $db_result[$i]['cash_collected'],
                        $db_result[$i]['is_final'],
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

    function TripUpdate($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to update entity
            $query = "UPDATE trip SET
                    `vehicle_id`= :vehicle_id,
                    `route_id`= :route_id,
                    `trip_number`= :trip_number,
                    `fuel_consumed`= :fuel_consumed,
                    `distance_traveled`= :distance_traveled,
                    `cash_collected`= :cash_collected,
                    `is_final`= :is_final,
                    `is_active`=:is_active,
                    `is_deleted`=:is_deleted 
                WHERE `id`= :id";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
                'vehicle_id' => $requestObject->data->vehicle_id,
                'route_id' => $requestObject->data->route_id,
                'trip_number' => $requestObject->data->trip_number,
                'fuel_consumed' => $requestObject->data->fuel_consumed,
                'distance_traveled' => $requestObject->data->distance_traveled,
                'cash_collected' => $requestObject->data->cash_collected,
                'is_final' => $requestObject->data->is_final,
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
    
    function TripDelete($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to delete entity
            $query = "UPDATE trip SET `is_deleted`= 1 WHERE `id`= :id";

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