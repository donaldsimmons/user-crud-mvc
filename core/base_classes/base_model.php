<?php

	/*
	
		BaseModel
		
		Acts as the foundation for any models used in application.
		
		Creates and manages the PDO object that interfaces with the database.
		
		Validates submitted input for usernames and passwords. This ensures that database access is restricted if inproperly formatted authentication
			info is used.
	
	*/

	class BaseModel {
	
		protected $db;
	
		# sets up database connection through model-specific PDO object
		public function __construct($dsn,$db_user,$db_pass) {
		
			$this->db = new \PDO($dsn,$db_user,$db_pass);
			
			# enables the exception error mode for PDO objects
			$this->db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		
		}// end __Construct Function
		
		
		# validates the submitted username for proper format
		public function validateUsername($username) {
		
			if(!empty($username)) {
			
				$username = trim($username);
				
				# matches input w/ RegEx to ensure only letters and numbers are used
				if(preg_match('[^a-zA-Z0-9]',$username) == 1) {
  				
  					echo 'username false';
  				
  				}else{
  					
  					# returns the submitted user name for use in controller/model
  					return $username;
  				
  				}
 			
			}
		
		}// end ValidateUsername Function
		
		
		# validates the submitted password for proper format
		public function validatePassword($password) {
		
			if(!empty($password)) {
				
				$password = trim($password);
				
				# matches input w/ RegEx to ensure only letters and numbers are used
				if(preg_match('[^a-zA-Z0-9]',$password) == 1) {
 				
 					echo 'password false';
 				
 				}else{
 					
 					# returns the submitted user name for use in controller/model
 					return $password;
 				
 				}
 			
			}
		
		}// end ValidatePassword Function
			
	}// end BaseModel Class