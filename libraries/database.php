<?php

    class Database {
        public $host = DB_HOST;
        public $username = DB_USER;
        public $password = DB_PASS;
        public $db_name = DB_NAME;

        public $link;
        public $error;

        /*
        * Class Constructor
        */
        
        //constructor (executes when assigning an object)
        public function __construct()
        {
            //if in a function in a class and when wanting to call another function from class we have to use "this" keyword (this also applies to properities)
            //this enables them to become class properities that can be used
            $this->connect();
        }

        /*
        * Connector
        */

        private function connect() {
            $this->link = new mysqli ($this->host, $this->username, $this->password, $this->db_name);

            if (!$this->link) {
                $this->error = "Connection Failed: " . $this->link->connect_error;
                return false;
            }
        }

        /*
        *  Select
        */

        public function select($query) {
            $result = $this->link->query($query) or die($this->link->error.__LINE__);
            if ($result->num_rows > 0) {
                return $result;
            } else {
                return false;
            }
        }

        /*
        *  Select
        */

        public function insert($query) {
            $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

            //validate
            if ($insert_row) {
                header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?msg=" . urlencode('Record Added'));
            } else {
                trigger_error('Error: ('. $this->link->errno .') '. $this->link->error, E_USER_ERROR);
            }
        }

        /*
        *  Update
        */

        public function update($query) {
            $update_row = $this->link->query($query) or die($this->link->error.__LINE__);

            //validate
            if ($update_row) {
                header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?msg=" . urlencode('Record Updated'));
            } else {
                trigger_error('Error: ('. $this->link->errno .') '. $this->link->error, E_USER_ERROR);
            }
        }

        /*
        *  Update
        */

        public function delete($query) {
            $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);

            //validate
            if ($delete_row) {
                header("Location:" . htmlspecialchars($_SERVER['PHP_SELF']) . "?msg=" . urlencode('Record Deleted'));
            } else {
                trigger_error('Error: ('. $this->link->errno .') '. $this->link->error, E_USER_ERROR);
            }
        }
    }

?>