<?php

	$username = "Liisa Mikola";

   //var_dump($_POST);
   require("../../../config.php");
   require("session_start.php");
   $database = "if20_liisa_mi_1";
   //kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebassi
   if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	   $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	   //valmistan ette SQL käsu
	   $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	   echo $conn->error;
	   //seome käsuga pärisandmed
	   //i - integer, d - decimal, s - string
	   $stmt->bind_param("s", $_POST["ideainput"]);
	   $stmt->execute();
	   $stmt->close();
	   $conn->close();
   }
   require("header.php");
   
?>
<html lang="et">
 <body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <h1>Lisa mõte:</h1>
   <form method="POST">
	<input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
	<input type="submit" name="ideasubmit" value="Saada mõte ära!">
   </form>
  <hr>
  <button><a href="home.php">Tagasi avalehele</button>
  <hr>
  <button><a href="?logout=1">Logi välja</a>!</button>
  <hr>
 </body>
</html>
