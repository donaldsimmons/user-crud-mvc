<?php

	require 'core/base_classes/loader.php';
	require 'core/base_classes/base_controller.php';
	require 'core/base_classes/base_model.php';
	
	require 'core/database/db.php';
	
	require 'controllers/user_controller.php';
	require 'models/user_model.php';

	define("APP_NAME","User CRUD");
	define("BASE_PATH",basename(__DIR__));
	define("BASE_URL","http://localhost:8888/");
	
	$loader = new Loader($_GET,$_POST);
	
	$controller = $loader->loadController();
	
	$controller->executeAction();
	