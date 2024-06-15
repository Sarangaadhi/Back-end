<?php
    
    function EmployeeCreate($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to insert entity
            $query = "INSERT INTO `employee` 
            (`nic_number`, `first_name`, `last_name`, `address_line_1`, `address_line_2`, `city`, `telephone`, `email`, `designation`, `created_at`) VALUES
            (:nic_number, :first_name, :last_name, :address_line_1, :address_line_2, :city, :telephone, :email, :designation, current_timestamp())";

            // Query parameters
            $params = [
                'nic_number' => $requestObject->data->nic_number,
                'first_name' => $requestObject->data->first_name,
                'last_name' => $requestObject->data->last_name,
                'address_line_1' => $requestObject->data->address_line_1,
                'address_line_2' => $requestObject->data->address_line_2,
                'city' => $requestObject->data->city,
                'telephone' => $requestObject->data->telephone,
                'email' => $requestObject->data->email,
                'designation' => $requestObject->data->designation
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
 
    function EmployeeReadAll($requestObject){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];

        try {
            //Instantitate Database Class
            $db = new Database();

            $query = "SELECT 
                    `id`,
                    `nic_number`,
                    `first_name`,
                    `last_name`,
                    `address_line_1`,
                    `address_line_2`,
                    `city`,
                    `telephone`,
                    `email`,
                    `designation`,
                    `is_active`,
                    `is_deleted` 
                FROM employee 
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
                    $obj = new Employee(
                        $db_result[$i]['id'],
                        $db_result[$i]['nic_number'],
                        $db_result[$i]['first_name'],
                        $db_result[$i]['last_name'],
                        $db_result[$i]['address_line_1'],
                        $db_result[$i]['address_line_2'],
                        $db_result[$i]['city'],
                        $db_result[$i]['telephone'],
                        $db_result[$i]['email'],
                        $db_result[$i]['designation'],
                        $db_result[$i]['is_active'],
                        $db_result[$i]['is_deleted']
                    );
                    // print_r($obj);
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

    function EmployeeReadById($requestObject, $params){
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
                    `nic_number`,
                    `first_name`,
                    `last_name`,
                    `address_line_1`,
                    `address_line_2`,
                    `city`,
                    `telephone`,
                    `email`,
                    `designation`,
                    `is_active`,
                    `is_deleted` 
                FROM employee 
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
                    $obj = new Employee(
                        $db_result[$i]['id'],
                        $db_result[$i]['nic_number'],
                        $db_result[$i]['first_name'],
                        $db_result[$i]['last_name'],
                        $db_result[$i]['address_line_1'],
                        $db_result[$i]['address_line_2'],
                        $db_result[$i]['city'],
                        $db_result[$i]['telephone'],
                        $db_result[$i]['email'],
                        $db_result[$i]['designation'],
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

    function EmployeeUpdate($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to update entity
            $query = "UPDATE employee SET
                    `nic_number`= :nic_number,
                    `first_name`= :first_name,
                    `last_name`= :last_name,
                    `address_line_1`= :address_line_1,
                    `address_line_2`= :address_line_2,
                    `city`= :city,
                    `telephone`= :telephone,
                    `email`= :email,
                    `designation`= :designation,
                    `is_active`=:is_active,
                    `is_deleted`=:is_deleted 
                WHERE `id`= :id";

            // Query parameters
            $db_params = [
                'id' => $params["id"],
                'nic_number' => $requestObject->data->nic_number,
                'first_name' => $requestObject->data->first_name,
                'last_name' => $requestObject->data->last_name,
                'address_line_1' => $requestObject->data->address_line_1,
                'address_line_2' => $requestObject->data->address_line_2,
                'city' => $requestObject->data->city,
                'telephone' => $requestObject->data->telephone,
                'email' => $requestObject->data->email,
                'designation' => $requestObject->data->designation,
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
    
    function EmployeeDelete($requestObject, $params){
        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];
        try {
            //Instantitate Database Class
            $db = new Database();

            //SQL query to delete entity
            $query = "UPDATE employee SET `is_deleted`= 1 WHERE `id`= :id";

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