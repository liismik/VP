<?php

   require("../../../config.php");
   require("fnc_filmrelations.php");
   require("session_start.php");
   //$database = "if20_liisa_mi_1";
   
	$sortby = 0;
	$sortorder = 0;
   
   require ("header.php");
   //  <?php echo readfilms();  html'ist
   
?>
<!DOCTYPE html>
<html>
 <body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <h1>Filmitegelaste nimekiri:</h1>
	 <?php 
	 if(isset($_GET["sortby"]) and isset($_GET["sortorder"])){
		 if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 4){
			 $sortby = $_GET["sortby"];
		 }
		 if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2){
			 $sortorder = $_GET["sortorder"];
		 }
	 }
	 echo readpersonsinfilm($sortby, $sortorder);
	 ?>
  <hr>
  <button><a href="home.php">Tagasi avalehele</button>
  <hr>
  <button><a href="?logout=1">Logi välja</a>!</button>
  <hr>
 </body>
</html>
