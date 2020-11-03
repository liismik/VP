<?php   
    
	session_start();
   
   //kas on sisse loginud
   if(!isset($_SESSION["userid"])){
	   //suunatakse sunniviisiliselt sisselogimise lehele
	   header("Location: page.php");
	   exit();
	}
	
	//logime välja
	if(isset($_GET["logout"])){
		//hävitame sessiooni
		session_destroy();
		//suunatakse sunniviisiliselt sisselogimise lehele
	    header("Location: page.php");
	    exit();
	}
?>