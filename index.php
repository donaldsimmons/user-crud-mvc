<?php

	# requires base classes for using/extending app functionality
	require 'core/base_classes/loader.php';
	require 'core/base_classes/base_controller.php';
	require 'core/base_classes/base_model.php';
	
	# requires database connectivity settings (constants)
	require 'core/database/db.php';
	
	# requires models and controllers to be used in application
	require 'controllers/user_controller.php';
	require 'models/user_model.php';

	# defines constants for use in navigation and views
	define("APP_NAME","User CRUD");
	define("BASE_PATH",basename(__DIR__));
	define("BASE_URL","http://localhost:8888/");
	
	# creates a loader instance to manage URL requests
	$loader = new Loader($_GET,$_POST);
	
	# loads the correct controller - specified in URL
	$controller = $loader->loadController();
	
	# executes controller method called in URL
	$controller->executeAction();
	