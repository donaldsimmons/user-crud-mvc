<?php 

	class UserModel extends BaseModel {
	
		public function __construct($dsn,$db_user,$db_pass) {
		
			parent::__construct($dsn,$db_user,$db_pass);
		
		} 
		
		public function getUserByPassword($username,$password) {
		
			$statement = $this->db->prepare("
			
				SELECT user_id AS id, user_name AS username, user_full_name AS full_name
				FROM users
				WHERE (user_name = :name) AND 
						(user_pass = MD5(CONCAT(user_salt,:pass)))
			
			");
		
			if($statement->execute(array(":name"=>$username,":pass"=>$password))) {
			
				$rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
				
				if(count($rows) === 1) {
				
					return $rows[0];
				
				}else{
				
					echo 'trouble with query request';
				
				}
			
			}
		
		}// end GetUserByPassword Function
	
	}// end UserModel Class