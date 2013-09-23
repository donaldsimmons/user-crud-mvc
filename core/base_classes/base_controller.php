<?php

	/*
	
		BaseController
		
		Provides default functionality for any controller class. ALL controllers
			MUST extend/inherit from the BaseController.
			
		Provides functionality for executing the chosen method from a controller.
		
		Provides functionality for displaying selected view templates from a controller. ALL views templates MUST be stored in a subdirectory of the
			"views" folder. This subdirectory MUST be named after the controller's
			class name, minus the "Controller" string present in the class name.
			
			ie, "UserController" templates stored in  -> "views/user/template.inc"
	
	*/

	class BaseController {
	
		protected $action;
		
		protected $get_values;
		protected $post_values;
	
	
		# sets up necessary properties for use in class
		public function __construct($action,$get_values,$post_values=array()) {
		
			$this->action = $action;
			
			$this->get_values = $get_values;
			$this->post_values = $post_values;
			
		}// end __Construct Function
		
		
		# returns the method/action to be run in "index.php"
		public function executeAction() {
		
			return $this->{$this->action}();
		
		}// end ExecuteAction Function
	
	
		# renders the complete HTML page that will be selected from a controller
		protected function renderView($view_name="index",$page_title="",$view_data=array()) {
		
		
			# manipulates class name to define correct subdirectory for desired template 
			$controller_class = get_class($this);
			$class = explode("Controller",$controller_class);
			
			$template_directory = strtolower($class[0]);
			
			# defines path to HTML header and footer files - same for every view
			$header_path = "views/wrappers/header.inc";
			$footer_path = "views/wrappers/footer.inc";
		
			# chooses title for page if none is selected in controller
			($page_title == "") ? $title = APP_NAME : $title = $page_title;
		
			if($view_name == "index") {
			
				# selects default HTML page if no template is specified
				$view_path = "views/index.html";

				# runs function to display default page				
				$this->show($view_path,$view_data);
				
			}else{
			
				# creates dynamic file path to chosen template
				$view_path = "views/".$template_directory."/".$view_name.".inc";
			
				# constructs and renders the desired HTML page
				$this->show($header_path,$title);
				$this->show($view_path,$title,$view_data);
				$this->show($footer_path,$title,$view_data);
				
			}
		
		}// end RenderView Function
		
		
		# includes the selected template for display - passes in data to be used
		private function show($view_path,$page_title,$view_data=array()) {
			
			# checks if template is exists and can be read before attempting include
			if(is_readable($view_path)) {
				
				include $view_path;
				
			}
			
		}
	
	}// end BaseController Class