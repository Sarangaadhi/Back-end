<?php
    class Conductor{

        private int $id;
        private int $employee_id;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $employee_id, $is_active, $is_deleted){
            $this->id = $id;
            $this->employee_id = $employee_id;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'employee_id' => $this->employee_id,
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

        public function set_employee_id($employee_id){
            $this->employee_id = $employee_id;
        }

        public function get_employee_id(){
            return $this->employee_id;
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