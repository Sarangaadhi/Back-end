<?php
    class User{

        private int $id;
        private string $username;
        private string $email;
        private string $password;
        private bool $is_manager;
        private bool $is_admin;
        private bool $is_active;
        private bool $is_deleted;

        public function __construct($id, $username, $email, $password, $is_manager, $is_admin, $is_active, $is_deleted){
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->is_manager = $is_manager;
            $this->is_admin = $is_admin;
            $this->is_active = $is_active;
            $this->is_deleted = $is_deleted;
        }

        //Return JSON value
        public function make_json() {
            return [
                'id' => $this->id,
                'username' => $this->username,
                'email' => $this->email,
                'is_manager' => $this->is_manager,
                'is_admin' => $this->is_admin,
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

        public function set_username($username){
            $this->username = $username;
        }

        public function get_username(){
            return $this->username;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function get_email(){
            return $this->email;
        }

        public function set_password($password){
            $this->password = $password;
        }

        public function get_password(){
            return $this->password;
        }

        public function set_is_manager($is_manager){
            $this->is_manager = $is_manager;
        }

        public function get_is_manager(){
            return $this->is_manager;
        }

        public function set_is_admin($is_admin){
            $this->is_admin = $is_admin;
        }

        public function get_is_admin(){
            return $this->is_admin;
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