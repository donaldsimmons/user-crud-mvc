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
					
					$full_name_segments = explode(" ",$user_info["full_name"]);
					
					if(count($full_name_segments) == 3) {
					
						$first_name = $full_name_segments[0]." ".$full_name_segments[1];
						
						$last_name = $full_name_segments[2];
						
						$user_info["first_name"] = $first_name;
						$user_info["last_name"] = $last_name;
					
					}else{
					
						$first_name = $full_name_segments[0];
						
						$last_name = $full_name_segments[1];
					
						$user_info["first_name"] = $first_name;
						$user_info["last_name"] = $last_name;
						
					}
					
					return $user_info;
				
				}else{
				
					return false;
				
				}
				
			}
		
		}// end GetUserInfo Function
		
		public function createUser($user_info) {
		
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$result = '';
			for( $i = 0; $i < 8; $i++) {
			
				$result .= $characters[mt_rand(0, 61)];
			
			}
			
			$username = $user_info["new_username"];
			$password = md5($result.$user_info["new_password"]);
			$salt = $result;
			$full_name = $user_info["new_first_name"]." ".$user_info["new_last_name"]; 
			$height = $user_info["new_user_height"];
			$weight = $user_info["new_user_weight"];
			$target_weight = $user_info["new_target_weight"];
		
			$statement = $this->db->prepare("
			
				INSERT INTO users
				SET 
					user_name = :username,
					user_pass = :password,
					user_salt = :salt,
					user_full_name = :full_name,
					user_height = :height,
					user_weight = :weight,
					user_target_weight = :target_weight
			
			"); 
			
			if($statement->execute(array(
				":username" => $username,
				":password" => $password,
				":salt" => $salt,
				":full_name" => $full_name,
				":height" => $height,
				":weight" => $weight,
				":target_weight" => $target_weight
			))) {
			
				$signin_info = ["username"=>$username,"password"=>$password];
				
				return $signin_info;
			
			}else{
			
				return 'cant execute';
			
			}
		
		}// end CreateUser Function
		
		public function updateUser($user_id,$post_values) {
		
			$set_statement = "UPDATE users SET ";
			$where_statement = " WHERE user_id = :id";
			
			$query_values_statements = [];
			$query_values_input = [];
		
			foreach($post_values as $key => $index) {
			
				if(!empty($index)) {
				
					$$key = $index;
					
					//$keys_array[$key] = $index;
					
					switch($key) {
					
						case "full_name":
							
							$query_values_statements[] = "user_full_name = :full_name";
							
							$query_values_input[":full_name"] = $post_values["full_name"];
							
							break;
							
						case "user_height":
							
							$query_values_statements[] = "user_height = :height";
							
							$query_values_input[":height"] = $post_values["user_height"];
							
							break;
							
						case "user_weight":
							
							$query_values_statements[] = "user_weight = :weight";
							
							$query_values_input[":weight"] = $post_values["user_weight"];
							
							break;
							
						case "user_target_weight":
					
							$query_values_statements[] = "user_target_weight = :target_weight";
							
							$query_values_input[":target_weight"] = $post_values["user_target_weight"];
							
							break;
							
					}// end switch
					
				}// end if 			
			
			}// end loop
			
			$query_statement = implode(", ",$query_values_statements);
			$query_values_input[":id"] = $user_id;
			
			$sql_statement = $set_statement.$query_statement.$where_statement;
			
			$statement = $this->db->prepare($sql_statement);
			
			if($statement->execute($query_values_input)) {
			
				return true;
			
			}else{
			
				return false;
			
			}
		
		}// end UpdateUser Function
		
		public function deleteUser($user_id) {
		
			$statement = $this->db->prepare("
			
				DELETE FROM users
				WHERE user_id = :id
			
			");
			
			$statement->execute(array(":id" => $user_id));
		
		}// end DeleteUser Function
	
	}// end UserModel Class