<?php

	$username = "Liisa Mikola";
   require("../../../config.php");
   require("fnc_films.php");
   //$database = "if20_liisa_mi_1";
   
   //loen lehele kõik olemasolevad mõtted
   $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
   $stmt = $conn->prepare("SELECT * FROM film");
   //$stmt = $conn->prepare("SELECT peakiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
   
   echo $conn->error;
   //seome tulemuse muutujaga
   $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
   $stmt->execute(); //kasu kaivitamine
   $filmhtml = "\t <ol> \n "; //
   while($stmt->fetch()){
	   $filmhtml .= "\t \t <li>" .$titlefromdb ." \n";
	   $filmhtml .= "\t \t \t <ul> \n";
	   $filmhtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Kestus minutites: " .$durationfromdb ." minutit</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Zanr : " .$genrefromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t </ul> \n";
	   $filmhtml .= "\t \t </li> \n";
   }
   $filmhtml .= "\t </ol> \n";
   
   $stmt->close();
   $conn->close();
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">  
  <title><?php echo $username; ?> programmeerib veebi</title>
  
</head>
<html>
 <body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <h1>Filmi list:</h1>
  <hr>
  <?phhp echo readfilms(); ?>
  <?php echo $filmhtml; ?>
  <hr>
  <button><a href="home.php">Tagasi avalehele</button>
 </body>
</html>