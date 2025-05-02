<?php
namespace App;
use mysqli;	
class DB {
    public \mysqli $Connection;

    public function __construct() {
        $this->Connection = new \mysqli("localhost", "root", "", "ia_project");

        if ($this->Connection->connect_error) {
            die("Connection failed: " . $this->Connection->connect_error);
        }
    }
}
