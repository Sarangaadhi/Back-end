<?php
    class RouteType{

        private int $id;
        private int $route_type_name;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $route_type_name, $is_active, $is_deleted){
            $this->id = $id;
            $this->route_type_name = $route_type_name;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'route_type_name' => $this->route_type_name,
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

        public function set_route_type_name($route_type_name){
            $this->route_type_name = $route_type_name;
        }

        public function get_route_type_name(){
            return $this->route_type_name;
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