<?php

	class BaseModel {
	
		protected $db;
	
		public function __construct($dsn,$db_user,$db_pass) {
		
			$this->db = new \PDO($dsn,$db_user,$db_pass);
			$this->db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		
		}// end __Construct Function
		
		public function validateUsername($username) {
		
			if(!empty($username)) {
			
				$username = trim($username);
				
			
				if(preg_match('[^a-zA-Z0-9]',$username) == 1) {
  				
  					echo 'username false';
  				
  				}else{
  				
  					return $username;
  				
  				}
 			
			}
		
		}// end ValidateUsername Function
		
		public function validatePassword($password) {
		
			
		
			if(!empty($password)) {
				
				$password = trim($password);
				
				if(preg_match('[^a-zA-Z0-9]',$password) == 1) {
 				
 					echo 'password false';
 				
 				}else{
 				
 					return $password;
 				
 				}
 			
			}
		
		}// end ValidatePassword Function
			
	}// end BaseModel Class