<?php

   require("session_start.php");
   
   //klassi testimine
   //require("classes/First_class.php");
   //$myclassobject = new First(10);
   //echo " Salajane arv on " .$myclassobject->mybusiness;
   //echo " Avalik arv on " .$myclassobject->everybodysbusiness;
   //$myclassobject->tellMe();
   //unset($myclassobject);
   //echo " Avalik arv on: " .$myclassobject->everybodysbusiness;
	
   require("header.php");
?>
<!DOCTYPE html>
<body>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <li><button><a href="addideas.php">Mõtete sisestamise leht</a></button></li>
  <li><button><a href="listideas.php">Mõtted</a></button></li>
  <li><button><a href="listfilms.php">Loe filmiinfot</a></button></li>
  <li><button><a href="addfilms.php">Lisa filme</a></button></li>
  <li><button><a href="userprofile.php">Minu kasutajaprofiil</a></button></li>
  <li><button><a href="filmconns.php">Filmiseosed</a></button></li>
  <li><button><a href="listfilmpersons.php">Filmitegelased</a></button></li>
  <li><button><a href="photoupload.php">Pildi üleslaadimine</a></button></li>
  <hr>
  <button><a href="?logout=1">Logi välja</a></button>
  <hr>
</body>
</html>