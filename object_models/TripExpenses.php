<?php
    class TripExpenses{

        private int $id;
        private int $trip_id;
        private string $description;
        private int $amount;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $trip_id, $description, $amount, $is_active, $is_deleted){
            $this->id = $id;
            $this->trip_id = $trip_id;
            $this->description = $description;
            $this->amount = $amount;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'trip_id' => $this->trip_id,
                'description' => $this->description,
                'amount' => $this->amount,
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

        public function set_trip_id($trip_id){
            $this->trip_id = $trip_id;
        }

        public function get_trip_id(){
            return $this->trip_id;
        }

        public function set_description($description){
            $this->description = $description;
        }

        public function get_description(){
            return $this->description;
        }

        public function set_amount($amount){
            $this->amount = $amount;
        }

        public function get_amount(){
            return $this->amount;
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