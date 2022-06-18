<?php
class Post {	
   
	private $postsTable = 'posts';
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	
	
	public function getPost(){		
		$sqlQuery = "
			SELECT *
			FROM ".$this->postsTable." ORDER BY id DESC limit 1";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();			
		return $result;	
	}
	
	public function insert(){
		
		if($this->message) {

			$stmt = $this->conn->prepare("
				INSERT INTO ".$this->postsTable."(`message`, `user`)
				VALUES(?, ?)");
						
			$stmt->bind_param("ss", $this->message, $this->user);
			
			if($stmt->execute()){	
				$lastPid = $stmt->insert_id;
				$sqlQuery = "
					SELECT id, message, user, DATE_FORMAT(created,'%d %M %Y %H:%i:%s') AS post_date
					FROM ".$this->postsTable." WHERE id = '$lastPid'";
				$stmt2 = $this->conn->prepare($sqlQuery);				
				$stmt2->execute();
				$result = $stmt2->get_result();
				$record = $result->fetch_assoc();
				echo json_encode($record);
			}		
		}
	}	
}
?>