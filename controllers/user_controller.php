<?php

	/*
	
		UserController
		
		The main controller for the application. Handles all controller functionality
			for the User CRUD operations.
			
		Calls UserModel to manipulate information in the database.
			
		Selects view template to be displayed and passes data to the view.
		
		Redirects user accordingly, based on chosen method/action and input	
	
	*/

	class UserController extends BaseController {
	
		private $model;
	
		# sets up controller, instantiates the model for use, and begins a new session for user
		public function __construct($action,$get_values,$post_values=array()) {
		
			parent::__construct($action,$get_values,$post_values);
			
			$this->model = new UserModel(MY_DSN,MY_USER,MY_PASS);
			
			session_start();
		
		}// end __Construct Function
		
		
		# provides the default functionality for the controller - called when no action is specified
		public function index() {
			
			# displays home page
			$this->renderView("home");
		
		}// end Index Function
		
		
		# handles signin functionality - communicates w/ model to signin, redirects to profile
		public function signin() {
			
			$username = $this->post_values["username"];
			$password = $this->post_values["password"];
			
			# checks for valid username/password combo
			if($this->model->validateUsername($username) && $this->model->validatePassword($password)) {
				
				# selects user's info from database to signin
				$user = $this->model->getUserByPassword($username,$password);
				
				if($user !== false) {
				
					# sets user id for use in profile
					$_SESSION["id"] = $user["id"];
				
					# redirects to the profile page
					header("Location: ".BASE_URL.BASE_PATH."/index.php/user/profile");
				
				}else{
				
					# shows error if user can't be logged in
					echo 'trouble logging in';
					
				}
				
			}
		
		}// end SignIn Function 
		
		
		# displays profile for signed-in user
		public function profile() {
			
			# checks for signed in user - restricts access to profiles
			if(isset($_SESSION["id"])) {
			
				$id = $_SESSION["id"];
				
				# retrieves user data for user in profile
				$user = $this->model->getUserInfo($id);
				
				# renders profile
				$this->renderView("profile","Profile",$user);
			
			}else{
			
				echo 'must be logged in';
			
			}
		
		}// end Profile Function
		
		
		# redirects user to signup form from the home page
		public function signup() {
			
			$this->renderView("signup","Sign Up Today!",$this->post_values);
		
		}// end SignUp Function
		
		
		# handles functionality for registering users with site
		public function registerUser() {
			
			# retrieve user data from signup form
			$new_user_info = $this->post_values;
			
			# validate username/password
			$username = $this->model->validateUsername($new_user_info["new_username"]);
			$password = $this->model->validatePassword($new_user_info["new_password"]);
			
			
			# checks submitted username/password for validity - if valid, creates new user
			if($username !== false && $password !== false) {
			
				# passes user info to model - adds user to database
				$new_user = $this->model->createUser($new_user_info);
			
				# retrieves user info using new username/password
				$user = $this->model->getUserByPassword($new_user["username"], $new_user_info["new_password"]);
				
				
				$_SESSION["id"] = $user["id"];
				
				# redirects to profile
				header("Location: ".BASE_URL.BASE_PATH."/index.php/user/profile");
			
			}else {
			
				echo 'trouble creating user';
			
			}
		
		}// end RegisterUser Function
		
		
		# uses edit form values to update user info
		public function editUser() {
			
			$id = $_SESSION["id"];
			$post = $this->post_values;
			
			# updates user info in database
			$updated_user = $this->model->updateUser($id,$post);
			
			
			if($updated_user == true) {
			
				# if user is successfully edited, reloads the profile
				header("Location: ".BASE_URL.BASE_PATH."/index.php/user/profile");
			
			}
		
		}// end editUser
		
		
		# handles deleting users' records
		public function deleteUser() {
		
			$id = $_SESSION["id"];
		
			# calls model to delete user record	
			$this->model->deleteUser($id);
			
			# unsets "logged-in" indicator from session array
			unset($_SESSION["id"]);
			
			# calls signout method to redirect to home page
			$this->signout();
		
		}//end DeleteUser Function
		
		
		# signs a user out of the app and redirects to home page
		public function signout() {
		
			# destroys session information
			session_destroy();
			
			# redirects to home
			header("Location: ".BASE_URL.BASE_PATH."/index.php");
		
		}// end SignOut Function
			
	}// end UserController Class