<?php
    class Trip{

        private int $id;
        private int $vehicle_id;
        private int $route_id;
        private int $trip_number;
        private int $fuel_consumed; // liters
        private int $distance_traveled; // meters
        private int $cash_collected; // cents
        private bool $is_final;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $vehicle_id, $route_id, $trip_number, $fuel_consumed, $distance_traveled, $cash_collected, $is_final, $is_active, $is_deleted){
            $this->id = $id;
            $this->vehicle_id = $vehicle_id;
            $this->route_id = $route_id;
            $this->trip_number = $trip_number;
            $this->fuel_consumed = $fuel_consumed;
            $this->distance_traveled = $distance_traveled;
            $this->cash_collected = $cash_collected;
            $this->is_final = $is_final;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'vehicle_id' => $this->vehicle_id,
                'route_id' => $this->route_id,
                'trip_number' => $this->trip_number,
                'fuel_consumed' => $this->fuel_consumed,
                'distance_traveled' => $this->distance_traveled,
                'cash_collected' => $this->cash_collected,
                'is_final' => $this->is_final,
                'is_active' => $this->is_active,
                'is_deleted' => $this->is_deleted,
            ];
        }

        //Getters and Setters

        public function set_id($id){
            $this->id = $id;
        }

        public function get_id(){
            return $this->id;
        }

        public function set_vehicle_id($vehicle_id){
            $this->vehicle_id = $vehicle_id;
        }

        public function get_vehicle_id(){
            return $this->vehicle_id;
        }

        public function set_route_id($route_id){
            $this->route_id = $route_id;
        }

        public function get_route_id(){
            return $this->route_id;
        }

        public function set_trip_number($trip_number){
            $this->trip_number = $trip_number;
        }

        public function get_trip_number(){
            return $this->trip_number;
        }

        public function set_fuel_consumed($fuel_consumed){
            $this->fuel_consumed = $fuel_consumed;
        }

        public function get_fuel_consumed(){
            return $this->fuel_consumed;
        }

        public function set_distance_traveled($distance_traveled){
            $this->distance_traveled = $distance_traveled;
        }

        public function get_distance_traveled(){
            return $this->distance_traveled;
        }

        public function set_cash_collected($cash_collected){
            $this->cash_collected = $cash_collected;
        }

        public function get_cash_collected(){
            return $this->cash_collected;
        }

        public function set_is_final($is_final){
            $this->is_final = $is_final;
        }

        public function get_is_final(){
            return $this->is_final;
        }

        public function set_is_active($is_active){
            $this->is_active = $is_active;
        }

        public function get_is_active(){
            return $this->is_active;
        }

        public function set_is_deleted($is_deleted){
            $this->is_deleted = $is_deleted;
        }

        public function get_is_deleted(){
            return $this->is_deleted;
        }

     
    }

?>