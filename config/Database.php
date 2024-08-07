<?php

    class Database{
        //DB Params [local]
        private $db_name = 'super3_backend';
        private $username = 'root';
        private $password = '';

        //DB Params [remote]
        // private $db_name = 'powerpos_super3';
        // private $username = 'powerpos_super3backend';
        // private $password = 'OQ1nNLu=^$Mx';

        private $host = 'localhost';
        private $conn;

        //DB Connect
        public function connect(){
            $this->conn = null;
        
            try{
                $this->conn = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                    $this->username, $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $ex) {
                echo 'Connection Error: ' .$ex->getMessage();
            }
            return $this->conn;
        }

        public function query($query, $params = array()){
            $conn = self::connect();
            $statement = $conn->prepare($query);
            $statement->execute($params);
            $last_id = $conn->lastInsertId();
            if (explode(' ', $query)[0] == 'SELECT'){
                $data = $statement->fetchAll();
                return $data;
            }else{
                return $last_id;
            }
        }

        public function getLastInsertedID(){
            return self::connect()->lastInsertId();
        }
        
    }

?>