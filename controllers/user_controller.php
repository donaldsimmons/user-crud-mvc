<?php

	class UserController extends BaseController {
	
		private $model;
	
		public function __construct($action,$url_values,$post_values=array()) {
		
			parent::__construct($action,$url_values,$post_values);
			
			$this->model = new UserModel(MY_DSN,MY_USER,MY_PASS);
			
			session_start();
		
		}// end __Construct Function
		
		public function index() {
			
			$this->renderView("home");
		
		}// end Index Function
		
		public function signin() {
			
			$username = $this->post_values["username"];
			$password = $this->post_values["password"];
			
			if($this->model->validateUsername($username) && $this->model->validatePassword($password)) {
				
				$user = $this->model->getUserByPassword($username,$password);
				
				if($user !== false) {
				
					$_SESSION["id"] = $user["id"];
				
					header("Location: ".BASE_URL.BASE_PATH."/index.php/user/profile/".$user["id"]);
				
				}else{
				
					echo 'trouble logging in';
					
				}
				
			}
			
		
		
		}// end SignIn Function 
		
		public function profile() {
			
			if(isset($_SESSION["id"])) {
			
				$id = $_SESSION["id"];
				
				$user = $this->model->getUserInfo($id);
				
				$this->renderView("profile","Profile",$user);
			
			}else{
			
				echo 'must be logged in';
			
			}
		
		}// end Profile Function
		
		public function signup() {
		
			$this->renderView("signup","Sign Up Today!",$this->post_values);
		
		}// end SignUp Function
		
		public function registerUser() {
			
			$new_user_info = $this->post_values;
			
			$username = $this->model->validateUsername($new_user_info["new_username"]);
			$password = $this->model->validatePassword($new_user_info["new_password"]);
			
			if($username !== false && $password !== false) {
			
				$new_user = $this->model->createUser($new_user_info);
			
				$user = $this->model->getUserByPassword($new_user["username"], $new_user_info["new_password"]);
				
				$_SESSION["id"] = $user["id"];
				
				header("Location: ".BASE_URL.BASE_PATH."/index.php/user/profile/".$user["id"]);
			}else {
			
				echo 'trouble creating user';
			
			}
		
		}// end RegisterUser Function
		
		public function signout() {
		
			
			session_destroy();
			
			header("Location: ".BASE_URL.BASE_PATH."/index.php");
		
		}// end SignOut Function
			
	}// end UserController Class