<?php
    class Dashboard{

        private int $vehicle_count;
        private int $driver_count;
        private int $conductor_count;
        private int $route_count;

        public function __construct(){
            $this->vehicle_count = 0;
            $this->driver_count = 0;
            $this->conductor_count = 0;
            $this->route_count = 0;
        }

        //Return JSON value
        public function make_json() {
            return [
                'vehicle_count' => $this->vehicle_count,
                'driver_count' => $this->driver_count,
                'conductor_count' => $this->conductor_count,
                'route_count' => $this->route_count
            ];
        }

        //Getters and Setters

        public function set_vehicle_count($vehicle_count){
            $this->vehicle_count = $vehicle_count;
        }

        public function get_vehicle_count(){
            return $this->vehicle_count;
        }

        public function set_driver_count($driver_count){
            $this->driver_count = $driver_count;
        }

        public function get_driver_count(){
            return $this->driver_count;
        }

        public function set_conductor_count($conductor_count){
            $this->conductor_count = $conductor_count;
        }

        public function get_conductor_count(){
            return $this->conductor_count;
        }

        public function set_route_count($route_count){
            $this->route_count = $route_count;
        }

        public function get_route_count(){
            return $this->route_count;
        }


    }
?>