<?php
    class Route{

        private int $id;
        private int $route_type_id;
        private string $route_number;
        private string $route_name;
        private string $route_description;
        private int $route_length;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $route_type_id, $route_number, $route_name, $route_description, $route_length, $is_active, $is_deleted){
            $this->id = $id;
            $this->route_type_id = $route_type_id;
            $this->route_number = $route_number;
            $this->route_name = $route_name;
            $this->route_description = $route_description;
            $this->route_length = $route_length;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'route_type_id' => $this->route_type_id,
                'route_number' => $this->route_number,
                'route_name' => $this->route_name,
                'route_description' => $this->route_description,
                'route_length' => $this->route_length,
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

        public function set_route_type_id($route_type_id){
            $this->route_type_id = $route_type_id;
        }

        public function get_route_type_id(){
            return $this->route_type_id;
        }

        public function set_route_number($route_number){
            $this->route_number = $route_number;
        }

        public function get_route_number(){
            return $this->route_number;
        }

        public function set_route_name($route_name){
            $this->route_name = $route_name;
        }

        public function get_route_name(){
            return $this->route_name;
        }

        public function set_route_description($route_description){
            $this->route_description = $route_description;
        }

        public function get_route_description(){
            return $this->route_description;
        }

        public function set_route_length($route_length){
            $this->route_length = $route_length;
        }

        public function get_route_length(){
            return $this->route_length;
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