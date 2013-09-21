<?php

	class BaseController {
	
		protected $action;
		
		protected $get_values;
		protected $post_values;
	
		public function __construct($action,$get_values,$post_values=array()) {
		
			$this->action = $action;
			
			$this->get_values = $get_values;
			$this->post_values = $post_values;
			
		
		}// end __Construct Function
		
		public function executeAction() {
		
			return $this->{$this->action}();
		
		}// end ExecuteAction Function
	
		protected function renderView($view_name="index",$page_title="",$view_data=array()) {
		
			$controller_class = get_class($this);
			$class = explode("Controller",$controller_class);
			
			$template_directory = strtolower($class[0]);
			
			$header_path = "views/wrappers/header.inc";
			$footer_path = "views/wrappers/footer.inc";
		
			($page_title == "") ? $title = APP_NAME : $title = $page_title;
		
			if($view_name == "index") {
			
				$view_path = "views/index.html";
				
				$this->show($view_path,$view_data);
				
			}else{
			
				$view_path = "views/".$template_directory."/".$view_name.".inc";
			
				$this->show($header_path,$title);
				$this->show($view_path,$title,$view_data);
				$this->show($footer_path,$title,$view_data);
				
			}
		
		}// end RenderView Function
		
		private function show($view_path,$page_title,$view_data=array()) {
			
			if(is_readable($view_path)) {
				
				include $view_path;
				
			}
			
		}
	
	}// end BaseController Class