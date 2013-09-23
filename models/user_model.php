<?php 

	/*
		
		BaseModel
		
		Connects with database to manipulate users' information.
		
		Handles all 4 CRUD actions for manipulating data - Create, Read, Update,
			Destroy.
		
	*/

	class UserModel extends BaseModel {

		# constructs the instance and sets up defaults from parent class (BaseModel)
		public function __construct($dsn,$db_user,$db_pass) {
		
			parent::__construct($dsn,$db_user,$db_pass);
		
		} 
		
		
		# uses username/password to retrieve user id for controller
		public function getUserByPassword($username,$password) {
			
			/*
			
			 	Defines SQL for PDO object interface w/ database	
			
				Uses username/password to select correct record
				
				Concatentates the input password and the user's salt to match
					input password against the hashed database record
			
			*/
			
			$statement = $this->db->prepare("
			
				SELECT user_id AS id
				FROM users
				WHERE (user_name = :name) AND 
						(user_pass = MD5(CONCAT(user_salt,:pass)))
			
			");
		
			# uses PDO's "execute" to pass in escaped values to query - queries database
			if($statement->execute(array(":name"=>$username,":pass"=>$password))) {
			
				# if the query can be executed, fetch the matching record
				$user = $statement->fetch(\PDO::FETCH_ASSOC);
				
				if(count($user) === 1) {
				
					# returns the user's id, if there is a matching record found
					return $user;
				
				}else{
				
					return false;
				
				}
			
			}
		
		}// end GetUserByPassword Function
		
		
		# retrieves user-specific info for use in profile
		public function getUserInfo($user_id) {
		
			# prepares database query for PDO object
			$statement = $this->db->prepare("
			
				SELECT user_name AS username, user_full_name AS full_name, 
						user_height AS height, user_weight AS weight, 
						user_target_weight AS target_weight
				FROM users
				WHERE (user_id = :id)
			
			");
			
			# uses signed-in user's id to retrieve correct data
			if($statement->execute(array(":id" => $user_id ))) {
			
				$user_info = $statement->fetch(\PDO::FETCH_ASSOC);
				
				if(count($user_info) !== 0) {
				
					$user_info["id"] = $user_id;
					
					# returns the retrieved information
					return $user_info;
				
				}else{
				
					return false;
				
				}
				
			}
		
		}// end GetUserInfo Function
		
		
		# creates a new user in the database using the escaped information from the signup form
		public function createUser($user_info) {
		
			# creates a random string to use as a "salt" for password
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$result = '';
			for( $i = 0; $i < 8; $i++) {
			
				$result .= $characters[mt_rand(0, 61)];
			
			}
			
			# defines values to be used in the sql query 
			$username = $user_info["new_username"];
			
			# concatenates, then hashes, the submitted password with the random salt for security
			$password = md5($result.$user_info["new_password"]);
			
			$salt = $result;
			$full_name = $user_info["new_first_name"]." ".$user_info["new_last_name"]; 
			$height = $user_info["new_user_height"];
			$weight = $user_info["new_user_weight"];
			$target_weight = $user_info["new_target_weight"];
		
		
			# builds SQL query to add database record
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
			
			# executes SQL query and adds record
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
				
				# returns data needed to retrieve new user's info for profile	
				return $signin_info;
			
			}else{
			
				return 'cant execute';
			
			}
		
		}// end CreateUser Function
		
		
		# updates user record in database using submitted info from edit form
		public function updateUser($user_id,$post_values) {
		
			# creates beginning and ending of SQL query - values to be updated will be added dynamically
			$set_statement = "UPDATE users SET ";
			$where_statement = " WHERE user_id = :id";
			
			$query_values_statements = [];
			$query_values_input = [];
		
			# loops over input to add query segments - allows for updates on variable number of fields
			foreach($post_values as $key => $index) {
			
				if(!empty($index)) {
					
					# adds query statements/parameters based on which fields are populated in post array
					switch($key) {
						
						case "full_name":
							
							# adds name update data to statements and input array
							$query_values_statements[] = "user_full_name = :full_name";
							
							$query_values_input[":full_name"] = $post_values["full_name"];
							
							break;
							
						case "user_height":
							
							# adds height update data to statements and input array
							$query_values_statements[] = "user_height = :height";
							
							$query_values_input[":height"] = $post_values["user_height"];
							
							break;
							
						case "user_weight":
							
							# adds weight update data to statements and input array
							$query_values_statements[] = "user_weight = :weight";
							
							$query_values_input[":weight"] = $post_values["user_weight"];
							
							break;
							
						case "user_target_weight":
					
							# adds target_weight update data to statements and input array
							$query_values_statements[] = "user_target_weight = :target_weight";
							
							$query_values_input[":target_weight"] = $post_values["user_target_weight"];
							
							break;
							
					}// end switch
					
				}// end if 			
			
			}// end loop
			
			# creates one string from resulting array for edits to be made
			$query_statement = implode(", ",$query_values_statements);
			
			# creates single SQL statement for use in PDO "prepare method"
			$sql_statement = $set_statement.$query_statement.$where_statement;
			
			$statement = $this->db->prepare($sql_statement);
			
			# adds the user's id to the input fields - for use in "WHERE" condition
			$query_values_input[":id"] = $user_id;
			
			# executes the query, by referencing the necessary array values
			if($statement->execute($query_values_input)) {
			
				return true;
			
			}else{
			
				return false;
			
			}
		
		}// end UpdateUser Function
		
		
		# deletes the specified user record from the database table
		public function deleteUser($user_id) {
		
			# prepares SQL to delete matching user
			$statement = $this->db->prepare("
			
				DELETE FROM users
				WHERE user_id = :id
			
			");
			
			# deletes the record from the table
			$statement->execute(array(":id" => $user_id));
		
		}// end DeleteUser Function
	
	}// end UserModel Class