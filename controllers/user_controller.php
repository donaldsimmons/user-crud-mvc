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
				
				$this->model->getUserInfo($id);
			
				$this->renderView("profile","Profile");
			
			}else{
			
				echo 'must be logged in';
			
			}
		
		}// end Profile Function
		
		public function signup() {
		
			$this->renderView("signup","Sign Up Today!",$this->post_values);
		
		}// end SignUp Function
		
		public function registerUser() {
		
			header("Location: index.php/user/profile");
		
		}// end RegisterUser Function
		
		public function signout() {
		
			
			session_destroy();
			
			header("Location: ".BASE_URL.BASE_PATH."/index.php");
		
		}// end SignOut Function
			
	}// end UserController Class