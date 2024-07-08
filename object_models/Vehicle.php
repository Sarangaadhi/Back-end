<?php
    class Vehicle{

        private int $id;
        private string $make;
        private string $model;
        private int $manufactured_year;
        private int $number_of_seats;
        private string $registration_number;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $make, $model, $manufactured_year, $number_of_seats, $registration_number, $is_active, $is_deleted){
            $this->id = $id;
            $this->make = $make;
            $this->model = $model;
            $this->manufactured_year = $manufactured_year;
            $this->number_of_seats = $number_of_seats;
            $this->registration_number = $registration_number;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'make' => $this->make,
                'model' => $this->model,
                'manufactured_year' => $this->manufactured_year,
                'number_of_seats' => $this->number_of_seats,
                'registration_number' => $this->registration_number,
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

        public function set_make($make){
            $this->make = $make;
        }

        public function get_make(){
            return $this->make;
        }

        public function set_model($model){
            $this->model = $model;
        }

        public function get_model(){
            return $this->model;
        }

        public function set_manufactured_year($manufactured_year){
            $this->manufactured_year = $manufactured_year;
        }

        public function get_manufactured_year(){
            return $this->manufactured_year;
        }

        public function set_number_of_seats($number_of_seats){
            $this->number_of_seats = $number_of_seats;
        }

        public function get_number_of_seats(){
            return $this->number_of_seats;
        }

        public function set_registration_number($registration_number){
            $this->registration_number = $registration_number;
        }

        public function get_registration_number(){
            return $this->registration_number;
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