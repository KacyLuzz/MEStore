<?php 

if(!isset($_GET['s'])) {
	
	/*
	 * 
	 * Step 1
	 * MySQL Configuration
	 * 
	 */
	
	include('steps/1.php');
	
} else if ($_GET['s'] == "2") {
	
	/*
	 * 
	 * Step 2
	 * Store Configuration
	 * 
	 */
	
	include('steps/2.php');
	
} else if ($_GET['s'] == "3") {
	
	/*
	 * 
	 * Step 3
	 * PayPal Configuration
	 * {parameters.json:disabled}
	 * 
	 */
	
	include('steps/3.php');
	
} else if ($_GET['s'] == "4") {
	
	/*
	 * 
	 * Step 4
	 * Administator Account Configuration
	 * 
	 */
	
	include('steps/4.php');
	
} else if ($_GET['s'] == "5") {
	
	/*
	 * 
	 * Step 4
	 * It's Done!
	 * 
	 */
	
	include('steps/5.php');
	
} 

?>