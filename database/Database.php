<?php


class Database {
    
    // Declare private database variables
    private $dbservername = "127.0.0.1:51750";
    private $dbusername = "azure";
    private $dbpassword = "6#vWHD_$";
    private $dbname = "milestone";
    
    // Class constructor
    function __construct() {
        
    }
    
    // Establish database connection
    function getConnection() {
        
        $conn = new mysqli($this->dbservername, $this->dbusername, $this->dbpassword, $this->dbname);
        if ($conn->connect_error) {
            echo "Connection failed " . $conn->connect_error . ".<br>";
        }
            
        return $conn;
    }
}