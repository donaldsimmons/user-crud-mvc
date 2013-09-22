<?php 

	class UserModel extends BaseModel {
	
		public function __construct($dsn,$db_user,$db_pass) {
		
			parent::__construct($dsn,$db_user,$db_pass);
		
		} 
		
		public function getUserByPassword($username,$password) {
		
			$statement = $this->db->prepare("
			
				SELECT user_id AS id
				FROM users
				WHERE (user_name = :name) AND 
						(user_pass = MD5(CONCAT(user_salt,:pass)))
			
			");
		
			if($statement->execute(array(":name"=>$username,":pass"=>$password))) {
			
				$user = $statement->fetch(\PDO::FETCH_ASSOC);
				
				if(count($user) === 1) {
				
					return $user;
				
				}else{
				
					return false;
				
				}
			
			}
		
		}// end GetUserByPassword Function
		
		public function getUserInfo($user_id) {
		
			$statement = $this->db->prepare("
			
				SELECT user_name AS username, user_full_name AS full_name, 
						user_height AS height, user_weight AS weight, 
						user_target_weight AS target_weight
				FROM users
				WHERE (user_id = :id)
			
			");
			
			if($statement->execute(array(":id" => $user_id ))) {
			
				$user_info = $statement->fetch(\PDO::FETCH_ASSOC);
				
				if(count($user_info) !== 0) {
				
					$user_info["id"] = $user_id;
					
					return $user_info;
				
				}else{
				
					return false;
				
				}
				
			}
		
		}// end GetUserFunction
	
	}// end UserModel Class