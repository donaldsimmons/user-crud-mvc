<?php

	/*
	
		Loader Class
		
		Uses URL requests to instantiate the desired controller and method/action.
		
		Will be instantiated in "index.php" file in root directory.
	
	*/


	class Loader {
		
		private $get_values;
		private $post_values;
		
		private $controller;
		private $action;
	
		# sets up loader instance and checks for valid controller/method to use
		public function __construct($get_values,$post_values) {
			
			$this->get_values = $get_values;
			$this->post_values =  $post_values;
				
			# calls private function to check for correct controller/action input		
			$this->checkValues($this->get_values);
		
		}// end __Construct Function
		
		
		# returns the desired controller instance for use in "index.php"
		public function loadController() {
		
			# stores any classes the selected controller extends for a validity check
			$parents = class_parents($this->controller);
			
			# checks for a valid controller that matches requested controller
			if(class_exists($this->controller)) {
			
				# checks if required default functionality is enabled in controller
				if(in_array("BaseController",$parents)) {
				
					# checks if selected method exists in controller
					if(method_exists($this->controller,$this->action)) {
					
						# if controller/action are valid, return instance of selected controller
						return new $this->controller($this->action,$this->get_values,$this->post_values);
					
					}else{
					
						echo 'false';
					
					}
				
				}else{
				
					echo 'false';
				
				}
			
			}else{
			
				echo 'false';
			
			}
		
		}// end LoadController Function
	
	
		# checks input and sets controller/action values to be used
		private function checkValues($url_values) {
		
			if(empty($url_values["controller"])) {
			
				# selects default controller, if none is specified
				$this->controller = "UserController";
			
			}else{
			
				# selects chosen controller for use
				$this->controller = $url_values["controller"]."Controller";
			
			}
			
			if(empty($url_values["action"])) {
			
				# selects default action for use, if none is specified
				$this->action = "index";
			
			}else{
			
				# selects chosen action for use
				$this->action = $url_values["action"];
			
			}
			
		}// end CheckValues Function
	
	}// end Loader Class