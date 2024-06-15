<?php
    class Employee{

        private int $id;
        private string $nic_number;
        private string $first_name;
        private string $last_name;
        private string $address_line_1;
        private string $address_line_2;
        private string $city;
        private string $telephone;
        private string $email;
        private string $designation;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $nic_number, $first_name, $last_name, $address_line_1, $address_line_2, $city, $telephone, $email, $designation, $is_active, $is_deleted){
            // try {
                $this->id = $id;
                $this->nic_number = is_null($nic_number) ? "" : $nic_number;
                $this->first_name = is_null($first_name) ? "" : $first_name;
                $this->last_name = is_null($last_name) ? "" : $last_name;
                $this->address_line_1 = is_null($address_line_1) ? "" : $address_line_1;
                $this->address_line_2 = is_null($address_line_2) ? "" : $address_line_2;
                $this->city = is_null($city) ? "" : $city;
                $this->telephone = is_null($telephone) ? "" : $telephone;
                $this->email = is_null($email) ? "" : $email;
                $this->designation = is_null($designation) ? "" : $designation;
                $this->is_active = $is_active;
                $this->is_deleted = $is_deleted;
            // } catch (Exception $ex) {
            //     print_r("Exception: " . $ex);
            // }finally{
            //     //print_r($this);
            // }
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'nic_number' => $this->nic_number,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'address_line_1' => $this->address_line_1,
                'address_line_2' => $this->address_line_2,
                'city' => $this->city,
                'telephone' => $this->telephone,
                'email' => $this->email,
                'designation' => $this->designation,
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

        public function set_nic_number($nic_number){
            $this->nic_number = $nic_number;
        }

        public function get_nic_number(){
            return $this->nic_number;
        }

        public function set_first_name($first_name){
            $this->first_name = $first_name;
        }

        public function get_first_name(){
            return $this->first_name;
        }

        public function set_last_name($last_name){
            $this->last_name = $last_name;
        }

        public function get_last_name(){
            return $this->last_name;
        }

        public function set_address_line_1($address_line_1){
            $this->address_line_1 = $address_line_1;
        }

        public function get_address_line_1(){
            return $this->address_line_1;
        }

        public function set_address_line_2($address_line_2){
            $this->address_line_2 = $address_line_2;
        }

        public function get_address_line_2(){
            return $this->address_line_2;
        }

        public function set_city($city){
            $this->city = $city;
        }

        public function get_city(){
            return $this->city;
        }

        public function set_telephone($telephone){
            $this->telephone = $telephone;
        }

        public function get_telephone(){
            return $this->telephone;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function get_email(){
            return $this->email;
        }

        public function set_designation($designation){
            $this->designation = $designation;
        }

        public function get_designation(){
            return $this->designation;
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