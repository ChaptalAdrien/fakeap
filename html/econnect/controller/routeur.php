<?php


	//require_once File::build_path(array('controller','Controller.php'));
	
	//Default controller
	$controller_default="user"; 
	
	//If the controller is set with the GET or POST methods, else we set the controller with the default controller
	if (isset($_GET['controller'])) {
		$controller=$_GET['controller'];
	

	}else if (isset($_POST['controller'])){
	
		$controller=$_POST['controller'];
	
	}else {

		$controller = $controller_default;
	}
			
	//We use the build path method to check if this file really exist
	//In this case we require the file and do the same with the action
	//If not, we setup the default controller		
	$controller_class="Controller" . ucfirst($controller);
	$path=array("controller","$controller_class.php");
	$filepath = File::build_path($path);

	
	
	if (file_exists($filepath)) {
		
		require_once $filepath;
		

		if(class_exists($controller_class)) {
			
			$methods=get_class_methods($controller_class);
			if (isset($_GET['action'])) {
		
				$action=$_GET["action"];
			
			}else if(isset($_POST['action'])){
		
				$action=$_POST["action"];
		
			}else{
				
				$action = "connexion_page";
			}
				
			if(in_array($action, $methods)) {
			
				$controller_class::$action();
			}
			
			else {
		
				//$controller_class::home();		
			}
				
		}else {
			
			//controller_class::();
		}
	
	}else {
		
		$controller = $controller_default;
	
	}

	



?>