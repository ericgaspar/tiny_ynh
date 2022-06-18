<?php
class Database{
	
	private $host  = 'localhost';
    private $user  = '__DB_USER__';
    private $password   = "__DB_PWD__";
    private $database  = "__DB_NAME__"; 
    
    public function getConnection(){		
		$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
?>