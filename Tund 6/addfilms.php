<?php

   require("../../../config.php");
   require("fnc_films.php");
   require("session_start.php");
   //$database = "if20_liisa_mi_1";
   
   $inputerror = "";
   //kui klikiti submit, siis ...
   if(isset($_POST["filmsubmit"])){
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])){
		$inputerror .= "Osa infot on sisestamata!";
	}
	if($_POST["yearinput"] > date("Y") or ($_POST["yearinput"] < 1895)){
		$inputerror .= "Ebareaalne valmimisaasta!";
	}
	if(empty($inputerror)){
		savefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
	}
   }
	   
   require("header.php");
?>
<!DOCTYPE html>
<html>
 <body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
  <hr>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="titleinput">Filmi pealkiri</label>
	<input type ="text" name="titleinput" id="titleinput"
	placeholder="Pealkiri">
	<br>
	<label for="yearinput">Filmi valmistamisaasta</label>
	<input type ="number" name="yearinput" id="yearinput" value="
	<?php echo date("Y"); ?>">
	<br>
	<label for="durationinput">Filmi kestus minutites</label>
	<input type ="number" name="durationinput" id="durationinput" value="80">
	<br>
	<label for="genreinput">Filmi zanr</label>
	<input type ="text" name="genreinput" id="genreinput"
	placeholder="Zanr">
	<br>
	<label for="studioinput">Filmi tootja</label>
	<input type ="text" name="studioinput" id="studioinput"
	placeholder="Tootja">
	<br>
	<label for="directorinput">Filmi lavastaja</label>
	<input type ="text" name="directorinput" id="directorinput"
	placeholder="Lavastaja">
	<br>
	<input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
  <p><?php echo $inputerror; ?></p>
  <button><a href="home.php">Tagasi avalehele</button>
  <hr>
  <button><a href="?logout=1">Logi välja</a>!</button>
  <hr>
 </body>
</html>