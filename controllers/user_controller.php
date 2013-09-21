<?php

	class UserController extends BaseController {
	
		private $model;
	
		public function __construct($action,$url_values,$post_values=array()) {
		
			parent::__construct($action,$url_values,$post_values);
			
			$this->model = new UserModel(MY_DSN,MY_USER,MY_PASS);
		
		}// end __Construct Function
		
		public function index() {
			
			$this->renderView("home");
		
		}// end Index Function
		
		public function signin() {
			
			$username = $this->post_values["username"];
			$password = $this->post_values["password"];
			
			if($this->model->validateUsername($username) && $this->model->validatePassword($password)) {
				
				$rows = $this->model->getUserByPassword($username,$password);
				header('Location: index.php/user/signup');
				
			}
			
		
		
		}// end SignIn Function 
		
		public function signup() {
		
			$this->renderView("signup","Sign Up Today!");
		
		}// end SignUp Function
		
		public function registerUser() {
		
			header("Location: index.php/user/profile");
		
		}// end RegisterUser Function
		
		public function profile() {
		
			$this->renderView('home');
		
		}// end Profile Function
	
	}// end UserController Class