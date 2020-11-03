<?php

	require("../../../config.php");
	require("fnc_films.php");
	require("session_start.php");
	
  $studionotice = "";
  $personnotice = "";
  $filmgenrenotice = "";
  $filmnotice = "";
  $positionnotice = "";

  $firstname = "";
  $lastname = "";
  $birthday = null;
  $birthmonth = null;
  $birthyear = null;
  $birthdate = null;

  $title = "";
  $productionyear = null;
  $duration = null;
  $filmdescription = "";

  $filmgenre = "";
  $genredescription = "";

  $studioname = "";
  $studioaddress = "";

  $position = "";
  $positiondescription = "";

  $studioerror = "";
  $firstnameerror = "";
  $lastnameerror = "";
  $birthdayerror = "";
  $birthmontherror = "";
  $birthyearerror = "";
  $birthdateerror = "";
  $filmgenreerror = "";
  $titleerror = "";
  $productionyearerror = "";
  $durationerror = "";
  $positionerror = "";

	// if(isset($_POST["personsubmit"])){
	 // if(empty($_POST["personfirstnameinput"]) or empty($_POST["personlastnameinput"]) or empty($_POST["personbirthdateinput"])){
		// $inputerror .= "Osa infot on sisestamata!";
	 // }
	 // if(empty($inputerror)){
		// saveperson($_POST["personfirstnameinput"], $_POST["personlastnameinput"], $_POST["personbirthdateinput"]);
	 // }
	 // if(empty($personfirstnameerror) and empty($personlastnameerror) and empty($personbirthdateerror)){
		// $notice = "Näitleja info lisamine õnnestus!";
	 // }
	// }
	
  if(isset($_POST["filmsubmit"]))  {
    $filmdescription = test_input($_POST["filmdescriptioninput"]);
    if(empty($_POST["titleinput"])){
        $titleerror = "Filmi pealkiri sisestamata!";
    }
    else {
        $title = test_input($_POST["titleinput"]);
        
    }
    if(empty($_POST["productionyearinput"])){
      $productionyearerror = "Filmi tootmisaasta sisestamata!";
    }
    else {
        $productionyear = test_input($_POST["productionyearinput"]);
        
    }
    if(empty($_POST["durationinput"])){
      $durationerror = "Filmi kestus sisestamata!";
    }
    else {
        $duration = test_input($_POST["durationinput"]);
        
    }
    if(empty($titleerror) and empty($productionyearerror) and empty($durationerror)){
        $result = savemovie($title, $productionyear, $duration, $filmdescription);
        if($result == "OK") {
          $filmnotice = "Film salvestatud!";
          $title = "";
          $productionyear = null;
          $duration = null;
          $filmdescription = "";
        }
        else {
          $filmnotice = $result;
        }
    }
  }
	
	// if(isset($_POST["positionsubmit"])){
		// if(empty($_POST["positionnameinput"]) or empty($_POST["positiondescriptioninput"])){
			// $inputerror .= "Osa infot on sisestamata!";
		// }
		// if(empty($inputerror)){
			// saveposition($_POST["positionnameinput"], $_POST["positiondescriptioninput"]);
		// }
		// if(empty($positionnameinputerror) and empty($positiondescriptioninputerror)){
			// $notice = "Näitleja info lisamine õnnestus!";
		// }
	// }
	
	// if(isset($_POST["genresubmit"])){
		// if(empty($_POST["genrenameinput"]) or empty($_POST["genredescriptioninput"])){
			// $inputerror .= "Osa infot on sisestamata!";
		// }
		// if(empty($inputerror)){
			// savegenre($_POST["genrenameinput"], $_POST["genredescriptioninput"]);
		// }
		// if(empty($genrenameinputerror) and empty($genredescriptioninputerror)){
			// $notice = "Näitleja info lisamine õnnestus!";
		// }
	// }
	
	require("header.php");
	
?>
<!DOCTYPE html>
<body>
 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
 <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
 <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
 <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate Instituudis.</p>
 <hr>
 
	 <h1>Lisa näitleja:</h1>
	 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label for="personfirstnameinput">Eesnimi</label>
	  <input type="text" name="personfirstnameinput" id="personfirstnameinput" placeholder="Eesnimi">
	  <br>
	  <label for="personlastnameinput">Perekonnanimi</label>
	  <input type="text" name="personlastnameinput" id="personlastnameinput" placeholder="Perekonnanimi">
	  <br>
	  <label for="personbirthdateinput">Sünniaeg(aasta-kuu-päev, numbrites)</label>
	  <input type="text" name="personbirthdateinput" id="personbirthdateinput" placeholder="Sünniaeg">
	  <br>
	  <br>
	  <input type="submit" name="personsubmit" value="Salvesta näitleja info">
	 </form>
	 <hr>
	 
  <h1>Lisa film</h1>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="titleinput">Filmi pealkiri</label>
    <input type="text" name="titleinput" id="titleinput" placeholder="Filmi pealkiri" value="<?php echo $title; ?>">
    <span><?php echo $titleerror; ?></span>
    <br />
    <label for="productionyearinput">Tootmisaasta</label>
    <input type="number" name="productionyearinput" id="productionyearinput" placeholder="<?php echo date("Y"); ?>" value="<?php echo $productionyear; ?>">
    <span><?php echo $productionyearerror; ?></span>
    <br />
    <label for="durationinput">Filmi kestus</label>
    <input type="number" name="durationinput" id="durationinput" placeholder="90" value="<?php echo $duration; ?>">
    <span><?php echo $durationerror; ?></span>
    <br />
    <label for="filmdescriptioninput">Filmi lühikirjeldus</label>
    <br />
    <textarea rows="5" cols="30" name="filmdescriptioninput" id="filmdescriptioninput" placeholder="Filmi lühitutvustus"><?php echo $filmdescription; ?></textarea>
    <br />
    <input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
  <p><?php echo $filmnotice; ?></p>
	  
	  <h1>Lisa positsioon:</h1>
	  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label for="positionnameinput">Positsiooni nimetus</label>
	  <input type="text" name="positionnameinput" id="positionnameinput" placeholder="Positsiooni nimetus">
	  <br>
	  <label for="positiondescriptioninput">Positsiooni kirjeldus</label>
	  <br>
	  <textarea rows="10" cols="80" name="positiondescriptioninput" id="positiondescriptioninput" placeholder="Positsiooni kirjeldus..."></textarea>
	  <br>
	  <br>
	  <input type="submit" name="positionsubmit" value="Salvesta positsiooni info">
	 </form>

	 <hr>
	 
	 <h1>Lisa zanr:</h1>
	 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	 <label for="genrenameinput">Zanri nimetus</label>
	 <input type="text" name="genrenameinput" id="genrenameinput" placeholder="Zanri nimetus">
	 <br>
	 <label for="genredescriptioninput">Kirjeldus</label>
	 <br>
	 <textarea rows="10" cols="80" name="genredescriptoninput" id="genredescriptioninput" placeholder="Filmi kirjeldus..."></textarea>
	 <br>
	 <br>
	 <input type="submit" name="positionsubmit" value="Salvesta positsiooni info">
	 </form>

	 
 <hr>
 <button><a href="home.php">Tagasi avalehele</button>
 <hr>
 <button><a href="?logout=1">Logi välja</a>!</button>
 <hr>
</body>