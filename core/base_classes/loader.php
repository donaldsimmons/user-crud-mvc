<?php

	class Loader {
	
		private $get_values;
		private $post_values;
		
		private $controller;
		private $action;
		private $id;
	
		public function __construct($get_values,$post_values) {
		
			$this->get_values = $get_values;
			$this->post_values =  $post_values;
						
			$this->checkValues($this->get_values);
		
		}// end __Construct Function
		
		public function loadController() {
		
			$parents = class_parents($this->controller);
			
			if(class_exists($this->controller)) {
			
				if(in_array("BaseController",$parents)) {
				
					if(method_exists($this->controller,$this->action)) {
					
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
	
		private function checkValues($url_values) {
		
			if(empty($url_values["controller"])) {
			
				$this->controller = "UserController";
			
			}else{
			
				$this->controller = $url_values["controller"]."Controller";
			
			}
			
			if(empty($url_values["action"])) {
			
				$this->action = "index";
			
			}else{
			
				$this->action = $url_values["action"];
			
			}
			
			if(empty($url_values["id"])) {
			
				$this->id = "";
			
			}else{
			
				$this->id = $url_values["id"];
				
			}
			
		}// end CheckValues Function
	
	}// end Loader Class