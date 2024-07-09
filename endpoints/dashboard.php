<?php
   
    function DashboardLoad($requestObject){

        $response = [
            'http_code' => http_response_code(200),
            'data' => null
        ];

        try {

            $obj = new Dashboard();

            //inititalize reults array
            $results = [];

            //Instantitate Database Class
            $db = new Database();



            //Load Vehicle Count
            $query = "SELECT 
                    count(`id`) as vehicle_count 
                FROM vehicle 
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

            if(count($db_result) > 0){
                $obj->set_vehicle_count($db_result[0]['vehicle_count']);
            }



            //Load Driver Count
            $query = "SELECT 
                    count(`id`) as driver_count 
                FROM driver 
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

            if(count($db_result) > 0){
                $obj->set_driver_count($db_result[0]['driver_count']);
            }


            //Load Conductor Count
            $query = "SELECT 
                count(`id`) as conductor_count 
            FROM conductor 
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

            if(count($db_result) > 0){
                $obj->set_conductor_count($db_result[0]['conductor_count']);
            }


            //Load Route Count
            $query = "SELECT 
                count(`id`) as route_count 
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

            if(count($db_result) > 0){
                $obj->set_route_count($db_result[0]['route_count']);
            }







            //Pushing objects to results array
            array_push($results,$obj->make_json());

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
